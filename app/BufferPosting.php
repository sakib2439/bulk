<?php

namespace Bulkly;

use Illuminate\Database\Eloquent\Model;

class BufferPosting extends Model
{
   public function groupInfo()
    {
        return $this->hasOne(SocialPostGroups::Class, 'id', 'group_id');
    }
   public function accountInfo()
    {
        return $this->hasOne(SocialAccounts::Class, 'id', 'account_id');
    }

    public function user()
    {
        return $this->hasOne(User::Class, 'id', 'user_id');
    }

    public function post()
    {
        return $this->hasOne(SocialPosts::Class, 'id', 'post_id');
    }



}
