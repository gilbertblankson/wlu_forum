<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostReaction;
use App\PostReactionLog;
use App\NumberOfView;
use App\Reply;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function showPreviewPage(){
        return view('preview');
    }

    public function showCommunityPage(){

        $categories = Category::withCount('posts')->orderBy('category_alias','asc')->get();
        
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('community',compact('categories','posts'));
    }


    public function createReply($post,$title){
           $this->validate(request(),[
            'reply'=>'required',
        ]);

        $current_time= \Carbon\Carbon::now()->format('Y-m-d H:i:s'); 

        Reply::create([
            'user_id'=>auth()->id(),
            'post_id'=>$post,
            'reply_body'=>request('reply'),
            'created_at'=> $current_time,
        ]);

      return redirect('single-post/'.$post.'/'.$title); 

     }

    public function createPost(){
      
        //create post
        //create first view by user
        //create a post reactions record with (likes:0  dislikes: 0)
        //redirect to single post page

        $this->validate(request(),[
            'category'=>'required',
            'post_title'=>'string|max:200|required',
            'post_body'=>'required',
        ]);

        $current_time= \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $post = Post::create([
            'user_id'=>auth()->id(),
            'category_id'=>request('category'),
            'post_title'=>request('post_title'),
            'post_body'=>request('post_body'),
            'moderated'=>'true',
            'created_at'=>$current_time,
            'updated_at'=>$current_time,
            'last_edited_at'=>$current_time,
        ]);

        PostReaction::create([
            'post_id' => $post->id,
            'number_of_likes' => 0,
            'number_of_dislikes' => 0,
        ]);

        return redirect('single-post/'.$post->id.'/'.$post->post_title);

    }

    public function showSinglePost($post,$title){

        //get selected post object
        //get owner placeholder
        //get categories
        //increment number of views

        $selected_post = Post::find($post);
        $replies = Reply::where('post_id','=',$selected_post->id)->orderBy('created_at','desc')->get();
        $first_placeholder = strtoupper(substr($selected_post->owner->firstname,0,1));
        $second_placeholder = strtoupper(substr($selected_post->owner->lastname,0,1));
        $user_placeholder = $first_placeholder.$second_placeholder;

        $categories = Category::orderBy('category_alias','asc')->get();

         NumberOfView::firstOrCreate(
            ['user_id'=>auth()->id(),'post_id'=>$selected_post->id]
        );

        return view('single-post',compact('selected_post','user_placeholder','replies','categories'));
    }

    public function searchTopics(){
          $this->validate(request(),[
            'comm-search'=>'required|string',
        ]);

        $categories = Category::withCount('posts')->orderBy('category_alias','asc')->get();
        $posts = Post::where('post_title','ILIKE','%'.request('comm-search').'%')->orWhere('post_body','ILIKE','%'.request('comm-search').'%')->paginate(100);
        
        return view('search-results',compact('categories','posts'));
    }

    public function sortByCategory($post,$title){
        $category = Category::find($post);
        $category_name = $category->category_alias;
        $categories = Category::withCount('posts')->orderBy('category_alias','asc')->get();
        $posts = Post::where('category_id','=',$post)->orderBy('created_at','desc')->paginate(10);

        return view('community-category',compact('categories','posts','category_name'));
    }

    //post reactions
    public function likePost(){
        //check if user has already reacted to post
        $user_id = request('user_id');
        $post_id = request('post_id');

        $reacted = PostReactionLog::where('user_id','=',$user_id)->where('post_id','=',$post_id)->first(); 
         if ($reacted === null){

                PostReactionLog::create([
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'reaction_type_id' => '1'
                ]);

                $post = PostReaction::where('post_id','=',$post_id)->first();

                $no_likes = (int)$post->number_of_likes+1;
                $post->number_of_likes = $no_likes;
                $post->save();

                return response()->json($post);
            }else{
                return response()->json();
            }
    }

    public function dislikePost(){
        $user_id = request('user_id');
        $post_id = request('post_id');

        $reacted = PostReactionLog::where('user_id','=',$user_id)->where('post_id','=',$post_id)->first(); 
        if ($reacted === null){

            PostReactionLog::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'reaction_type_id' => '1'
            ]);

            $post = PostReaction::where('post_id','=',$post_id)->first();
            $no_dislikes = (int)$post->number_of_dislikes+1;
            $post->number_of_dislikes = $no_dislikes;
            $post->save();

            return response()->json($post);
        }else{
            return response()->json();
        }
           

      
    }

}