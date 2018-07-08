<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['comment','author'];

    public static function getComment($postId,$parentId = 0){
    	$result = '';
    	$data = Comments::where('postId','=',$postId)->where('parentId','=',$parentId)->orderBy('id','asc')->get();
    	if($data){
    		$result = '<ul>';
            foreach ($data as $key => $comment) {
                $result .= '<li>';
                    $result .= '<b>'.$comment->author.'</b>: '.$comment->comment;
                $result .= '</li>';                
                $result .= Comments::getComment($postId,$comment->id);
            }
            $result .= '</ul>';
    	}
		return $result;
    }
}
