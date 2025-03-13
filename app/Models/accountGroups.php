<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountGroups extends Model
{
    function parent(){
        return $this->belongsTo(AccountGroup::class, 'parent_id');
    }

    function children(){
        return $this->hasMany(AccountGroup::class, 'parent_id');
    }

    function accounts(){
        return $this->hasMany(Account::class, 'account_group_id');
    }
}
