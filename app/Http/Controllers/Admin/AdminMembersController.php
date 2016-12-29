<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AdminUsersEditFormRequest;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\RegistrationFormRequest;
use Cartalyst\Sentry\Users\Eloquent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentry;

class AdminMembersController extends Controller
{
    /**
     * @var $user
     */
    protected $user;


    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;


        //$this->middleware('notCurrentUser', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $admin = Sentry::findGroupByName('Admins');
        $users = Sentry::findAllUsersInGroup($admin);
        return view('protected.admin.member.list-user')->withUsers($users)->withAdmin($admin);
    }

    /**
     * create page
     */
    public function create() {
        $object = new User();
        return view('protected.admin.member.add-user', compact('object'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RegistrationFormRequest $request)
    {
        $input = $request->only('email', 'password', 'first_name', 'last_name');

        $input = array_add($input, 'activated', true);

        $user = $this->user->create($input);

        // Find the group using the group name
        $usersGroup = \Sentry::findGroupByName('Admins');

        // Assign the group to the member
        $user->addGroup($usersGroup);

        return Redirect::to('admin/member')->with('success', trans('message.SUCCESS'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        $user_group = $user->getGroups()->first()->name;

        $groups = Sentry::findAllGroups();

        return view('protected.admin.show_user')->withUser($user)->withUserGroup($user_group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        $groups = Sentry::findAllGroups();

        $user_group = $user->getGroups()->first()->id;

        $array_groups = [];

        foreach ($groups as $group) {
            $array_groups = array_add($array_groups, $group->id, $group->name);
        }

        return view('protected.admin.member.add-user', ['object' => $user, 'groups' => $array_groups, 'user_group' =>$user_group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminUsersEditFormRequest $request)
    {
        $user = $this->user->find($id);
        if (! $request->has("password")) {
            if($request->input("email") == $user->email) {
                $input = $request->only('first_name', 'last_name');
            } else {
                $input = $request->only('email', 'first_name', 'last_name');
            }

            $user->fill($input)->save();

            $this->user->updateGroup($id, $request->input('account_type'));

        } else {
            if($request->input("email") == $user->email) {
                $input = $request->only('first_name', 'last_name', 'password');
            } else {
                $input = $request->only('email', 'first_name', 'last_name', 'password');
            }

            $user->fill($input)->save();

            $user->save();

            $this->user->updateGroup($id, $request->input('account_type'));
        }

        return Redirect::to('admin/member')->with('success', trans('message.SUCCESS'));
    }
}
