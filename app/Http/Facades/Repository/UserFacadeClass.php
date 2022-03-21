<?php

namespace App\Http\Facades\Repository;

use App\Repositories\Contract\UserRoleInterface;
use App\Repositories\Contract\UserInterface;

/**
 * Class UserFacadeClass
 *
 */
class UserFacadeClass
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $user, $UserRoleRepo;

    /**
     * User constructor.
     *
     * @param UserInterface $blockedAdjRepo
     */
    public function __construct(UserInterface $repo, UserRoleInterface $UserRoleInterface)
    {
        $this->user = $repo;
        $this->UserRoleRepo = $UserRoleInterface;
    }

    /**
     * @return mixed
     */
    public function view() {
        $data['userData'] = $this->user->getCollection();
        $data['userRoleData'] = $this->UserRoleRepo->getCollection();
        $data['userTab'] = "active";
        return $data;
    }

    /**
     * @param $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function getDataTable($request) {

        // get the fields for user list
        $userData = $this->user->getDatatableCollection();

        // get the filtered data of user list
        $userFilteredData = $this->user->getFilteredData($userData,$request);

        //  Sorting user data base on requested sort order
        $userCount = $this->user->getCount($userFilteredData);

        // Sorting user data base on requested sort order
        $userSortData = $this->user->getSortData($userFilteredData,$request);
        

        // get collection of user
        $userData = $this->user->getData($userSortData,$request);

        $appData = array();
        foreach ($userData as $userData) {
            $row = array();
            $row[] = $userData->first_name;
            $row[] = $userData->last_name;
            $row[] = $userData->email;
            $row[] = ($userData->role) ? $userData->Role->role : "---";
            $row[] = view('datatable.action', ['module' => "user", 'id' => $userData->id])->render();
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $userCount,
            'recordsFiltered' => $userCount,
            'data' => $appData,
        ];
    }

    /**
     * @return mixed
     */
    public function create() {
        $data['userTab'] = "active";
        $data['userData'] = $this->user->getCollection();
        $data['userRoleData'] = $this->UserRoleRepo->getCollection();
        return $data;
    }

    /**
     * Display the specified user.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['details'] = $this->user->getUserByField($id, 'id');
        $data['userRoleData'] = $this->UserRoleRepo->getCollection();
        $data['userTab'] = "active";
        return $data;
    }

    /**
     * Store and Update user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insertAndUpdateUser($requestData) {
        return $this->user->addUser($requestData);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id) {
        return $this->user->deleteUser($id);
    }
}