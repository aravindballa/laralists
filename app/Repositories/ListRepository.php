<?php
/**
 * Created by IntelliJ IDEA.
 * User: Aravind
 * Date: 01/06/17
 * Time: 1:00 AM
 */

namespace App\Repositories;

use App\Item;
use App\User;
use App\TodoList;

class ListRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return TodoList::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function itemsForList(int $id)
    {
        return Item::where('todo_list_id', $id)
            ->orderBy('completed', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}