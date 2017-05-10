<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\State;
use App\Location;
use Illuminate\Support\Facades\Auth;
use App\Demand;
use App\Tag;
use App\TagBlacklist;
use App\TagIgnored;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller {

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['states'] = State::all();
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
            'service_provider' => 'required',
            'remember_token' => str_random(10)
        ]);
        try {
            $u = $this->save($request);
            if (isset($u)) {
                $credentials = array(
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                );
                if (!Auth::attempt($credentials)) {
                    return redirect()->route('home')->with('message', 'user.error_authentication');
                }
            }
            return redirect()->route('dashboard')->with('message', 'user.create_success');
        } catch (Exception $e) {
            return back()->withInput()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $data['my'] = Auth::user();
        $data['user'] = User::find($id);
        $data['service_provider'] = $request->session()->get('service_provider');
        return view('user.dashboard-public', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|exists:users',
            'phone' => 'required',
            'status' => 'required',
            'service_provider' => 'required'
        ]);
        try {
            //$this->register($request);
            $this->save($request, $id);
            return back()->withInput()->with('message', 'user.update_success');
        } catch (Exception $e) {
            return back()->withInput()->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Post::destroy($id);
            return redirect()->route('admin.posts.index', $type_id)->with('message', 'post.destroy_success');
        } catch (Exception $e) {
            return back()->withInput()->with('message', $e->getMessage());
        }
    }

    public function changePhoto(Request $request, $id) {
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('upload/user'), $imageName);

        $image_resize = Image::make(public_path('upload/user/') . $imageName);
        $image_resize->fit(300, 300);
        $image_resize->save(public_path('upload/user/') . $imageName);

        $u = User::findOrFail($id);
        $u->update(['photo' => $imageName]);
        return back()->withInput();
    }

    public function changeAccount(Request $request) {
        $request->session()->put('service_provider', $request->service_provider);
        return back()->withInput();
    }

    /**
     * View profile user Auth
     * @return type
     */
    public function dashboard(Request $request) {
        $id = Auth::user()->id;
        $data['user'] = User::find($id);
        $data['states'] = State::all();
        $data['service_provider'] = $request->session()->get('service_provider');
        $data['my_regions'] = $data['user']->locations;
        $data['my_tags'] = $data['user']->tags;
        if ($data['user']->service_provider == 'y' && $data['service_provider'] != 'n') {
            $view = 'user.dashboard-provider';
            $data['my_demands'] = Demand::where(['user_id' => $id])->get();
            $data['demands'] = Demand::has('tags')
                    ->doesntHave('contacts')
                    //->has('tags')
                    ->join('demand_tag', 'demands.id', '=', 'demand_tag.demand_id')
                    ->join('tags', 'demand_tag.tag_id', '=', 'tags.id')
                    ->join('tag_user', 'tags.id', '=', 'tag_user.tag_id')
                    ->join('users', function($join) use ($id) {
                        $join->on('tag_user.user_id', '=', 'users.id')
                        ->where('users.id', $id);
                    })

                    ->select('demands.*')
                    ->get();
            $data['pending_demands'] = Demand::has('tags')
                    ->has('contacts')
                    //->has('tags')
                    ->join('demand_tag', 'demands.id', '=', 'demand_tag.demand_id')
                    ->join('tags', 'demand_tag.tag_id', '=', 'tags.id')
                    ->join('tag_user', 'tags.id', '=', 'tag_user.tag_id')
                    ->join('users', function($join) use ($id) {
                        $join->on('tag_user.user_id', '=', 'users.id')
                        ->where('users.id', $id);
                    })
                    ->select('demands.*')
                    ->get();
        } else {
            $view = 'user.dashboard';
            $data['my_demands'] = Demand::where(['user_id' => $id])->get();
            $data['my_conections'] = User::where(['status' => '2'])->get();
        }
        return view($view, $data);
    }

    public function save($request, $id = null) {
        $data = $request->all();
        $user = $this->validateCreateUser($data);
        try {
            if ($id) {
                $u = User::findOrFail($id);
                $u->update($user);
            } else {
                $u = User::Create($user);
            }
            $this->locations($request, $u);
            $this->chooseTags($request, $u);
            return $u;
        } catch (Exception $e) {
            return false;
        }
    }

    public function validateCreateUser($data = null) {
        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'content' => isset($data['content']) ? $data['content'] : 'Sobre mim',
            'cpf_cnpj' => $data['cpf_cnpj'],
            'status' => $data['status'],
            'service_provider' => $data['service_provider']
        ];
        if (isset($data['password']) && !empty($data['password'])) {
            $user['password'] = bcrypt($data['password']);
        }
        return $user;
    }

    public function locations(Request $request, User $u) {
        try {
            if (!isset($request->location) or ! is_array($request->location) or count($request->location) <= 0) {
                return false;
            }
            foreach ($request->location as $l) {
                if ($this->validateCreateLocation($l)) {
                    $l['user_id'] = $u->id;
                    Location::updateOrCreate($l);
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function validateCreateLocation($l = null) {
        if (is_array($l) && isset($l) &&
                isset($l['neighborhood_id']) &&
                !empty($l['neighborhood_id']) &&
                $l['neighborhood_id'] !== 'null' &&
                $l['neighborhood_id'] !== '' &&
                $l['neighborhood_id'] !== null &&
                isset($l['city_id']) &&
                !empty($l['city_id']) &&
                $l['city_id'] !== 'null' &&
                $l['city_id'] !== '' &&
                $l['city_id'] !== null &&
                isset($l['state_id']) &&
                !empty($l['state_id']) &&
                $l['state_id'] !== 'null' &&
                $l['state_id'] !== '' &&
                $l['state_id'] !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function account() {
        $data['user'] = Auth::user();
        $data['states'] = State::all();
        $data['my_locations'] = $data['user']->locations;
        $data['my_tags'] = $data['user']->tags;
        return view('user.account', $data);
    }

    public function chooseTags(Request $request, User $u) {
        try {
            if (!isset($request['tag']) or ! is_array($request['tag'])) {
                return false;
            }
            $tags = [];
            $tag_ignored = TagIgnored::pluck('tag_id')->all();
            $tag_balcklist = TagBlacklist::pluck('tag_id')->all();
            foreach ($request['tag'] as $str) {
                if (!in_array($str, $tag_ignored) || !in_array($str, $tag_balcklist)) {
                    $tags[] = Tag::updateOrCreate(['title' => $str, 'slug' => str_slug($str, '-')])->id;
                }
            }
            $u->tags()->sync($tags);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
