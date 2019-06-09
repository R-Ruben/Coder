<?php
namespace App\Helpers;

use App\Friend;
use App\Post;
use App\ProgrammingLanguage;

class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    /**
     * Gets the given user's friends
     *
     * @param [type] $id
     * @return friends
     */
    public function getFriends($id)
    {
        //Get entries from friendships
        $friendships = Friend::where('user_id', $id)->orWhere('receiving_user_id', $id)->orderBy('id', 'DESC')->get();
        $friends = [];

        //Get the correspondent, not self, and add to array
        foreach ($friendships->where('accepted', 1) as $friendship) {
            if ($friendship->user->id == auth()->user()->id) {
                $friends[] = $friendship->receiving_user;
            } else {
                $friends[] = $friendship->user;
            }
        }
        return json_encode($friends);
    }
/**
 * Gets the current user's friernd requests
 *
 * @return friendRequestUsers
 */
    public function getFriendRequests()
    {
        $friendRequests = Friend::where('receiving_user_id', auth()->user()->id)->where('accepted', 0)->orderBy('id', 'DESC')->get();
        $frUsers = [];
        foreach ($friendRequests as $friendRequest) {
            $frUsers[] = $friendRequest->user;
        }

        return $frUsers;
    }

    /**
     * Assign programming languages to post
     *
     * @param [type] $body
     * @param Post $post
     * @return void
     */
    public function AssignProgrammingLanguages($body, Post $post)
    {

        //Detach current programming languages (in case of edit)
        $post->programming_languages()->detach();

        // Check which programming language is used and assign to post
        if (strpos($body, 'language-')) {
            if (strpos($body, 'language-css"')) {
                $programmingLanguage = ProgrammingLanguage::find([1]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-javascript"')) {
                $programmingLanguage = ProgrammingLanguage::find([2]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-markup"')) {
                $programmingLanguage = ProgrammingLanguage::find([3]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-php"')) {
                $programmingLanguage = ProgrammingLanguage::find([4]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-ruby"')) {
                $programmingLanguage = ProgrammingLanguage::find([5]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-python"')) {
                $programmingLanguage = ProgrammingLanguage::find([6]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-java"')) {
                $programmingLanguage = ProgrammingLanguage::find([7]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-c"')) {
                $programmingLanguage = ProgrammingLanguage::find([8]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-csharp"')) {
                $programmingLanguage = ProgrammingLanguage::find([9]);
                $post->programming_languages()->attach($programmingLanguage);
            }
            if (strpos($body, 'language-cpp"')) {
                $programmingLanguage = ProgrammingLanguage::find([10]);
                $post->programming_languages()->attach($programmingLanguage);
            }

        } else {
            $programmingLanguage = ProgrammingLanguage::find([11]);
            $post->programming_languages()->attach($programmingLanguage);
        }
    }

}
