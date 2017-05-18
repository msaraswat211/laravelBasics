<?php

use App\Posts;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
---------------------------
insert data into post model
---------------------------
*/

//Route::get('/insert', function (){
//   DB::insert('insert into posts(title, content) values(?,?)', ['data 4', 'content 4']);
//});

/*
 * -------------------------------
 * read the data from post model
 * -------------------------------
 */

//Route::get('/read', function (){
//    $result=DB::select('select * from posts where id=?', [1]);
//
//    foreach($result as $post)
//    {
//        echo $post->title."<br>";
//    }
//
//});

/*
 * ---------------------------
 * update data in post model
 * ---------------------------
 */

//Route::get('/update', function(){
//    $result=DB::update('update posts set content ="content 3" where id= ?', [3]);
//});

/*
 * OR
 */

//Route::get('/update1/{content}/{id}', function($content, $id){
//    $result=DB::update('update posts set content =? where id= ?', [$content, $id]);
//});

/*
 * -----------------------------
 * delete data from post model
 * -----------------------------
 */

//Route::get('/delete', function(){
//    $result=DB::delete('delete from posts where id=?', [3]);
//});

/*
 * or how to truncate post model?
 */

/*
 * -------------------------using Eloquent / ORM ----------------
 */

/*
 * find all data from posts model
 */

Route::get('/find', function(){
    $posts=Posts::all();
    foreach($posts as $post){
        echo $post->title."<br>";
    }
});

/*
 * find specified data from posts model
 */

Route::get('/find1', function(){
    $posts=Posts::find(1);
    echo $posts."<br>";

    // for particular field like title only
    echo $posts->title;
});

/*
 * or
 */

Route::get('/find2/{id}', function($id){
    $posts=Posts::find($id);
    echo $posts."<br>";
});

/*
 * find data from model using get method & where clause with is_admin field
 */

Route::get('/findwhere', function(){
    $post=Posts::where('is_admin', 0)->get(); //return all record
    echo $post;
});

/*
 * find data from model using first method & where clause with is_admin field
 */

Route::get('/findwhere1', function(){
    $post=Posts::where('is_admin', 0)->first(); // return first record
    echo $post;
});

/*
 * find data in asc|desc order using orderBy()
 */

Route::get('/findwhere2', function(){
    $post=Posts::where('is_admin', 0)->orderBy('id', 'desc')->get();

    //if required first record according to orderby
    //$post=Posts::where('is_admin', 0)->orderBy('id', 'desc')->first();
    echo $post;
});

/*
 * get particular number of record from model using take()
 */

Route::get('/findwhere3', function(){
    $post=Posts::where('is_admin', 0)->orderBy('id', 'desc')->take(2)->get();
    echo $post;
});

/*
 * use of findOrFail()
 */

Route::get('/findorfail', function(){
    $post=Posts::where('is_admin', '<=', 0)->findOrFail(1);
    echo $post;
});

/*
 * use of firstOrFail()
 */

Route::get('/firstorfail', function(){
    $post=Posts::where('is_admin', '<=', 0)->firstOrFail;
    echo $post;
});

/*
 * insert record in model
 */

Route::get('/insert', function(){
    $post=new Posts;
    $post->title="data 5";
    $post->content="content 5";
    $post->save();
});

/*
 * or using fill()
 */

Route::get('/insert1', function(){
    $post=new Posts;
    $post->fill(['title'=>'data 8', 'content'=>'content 8']);
    $post->save();
});

/*
 * insert data another way with mass assignment
 */

Route::get('/insert2', function(){
    Posts::create(['title'=>'data 6', 'content'=>'content 6']);
});

/*
 * update record
 */

Route::get('/update', function(){
    $post=Posts::find(7);
    $post->title="data 7";
    $post->content="content 7";
    $post->save();
});

/*
 * or using fill()
 */

Route::get('/update1', function(){
    $post=Posts::find(7);
    $post->fill(['title'=>'data 7', 'content'=>'content 7']);
    $post->save();
});

/*
 * update record using where clause
 */

Route::get('/update2', function(){
    Posts::where('id', 7)->update(['title'=>"data new"]);
});

/*
 * update record using where clause chaining
 */

Route::get('/update3', function(){
    Posts::where('id', 7)->where('is_admin', 0)->update(['content'=>'content new']);
});

/*
 * delete record using delete()
 */

Route::get('/delete', function(){
    $post=Posts::find(1);
    //or
    //Posts::where('id',1)->delete();
    $post->delete();
});

/*
 * delete record using detroy()
 */

Route::get('/delete', function(){
    Posts::destroy(1);
    //or
    //Posts::destroy([1,2,3]);
});

/*
 * use of softdelete
 */

Route::get('/softdelete', function (){
    $post=Posts::find(4);
    $post->delete();
});

/*
 * ------------------------------------------------
 * retrive deleted/trashed data
 * ------------------------------------------------
 */

/*
 * retrive data using withTrashed()
 */

Route::get('/readsoftdelete', function(){
    $post=Posts::withTrashed()->get();
    // or
    // $post=Posts::withTrashed()->where('is_admin', 0)->get();
    foreach($post as $post) {
        echo $post . "<br>"; //return all record with trashed items
    }
});

/*
 * retrive data using onlyTrashed()
 */

Route::get('/readsoftdelete1', function(){
    $post=Posts::onlyTrashed()->get();
    // or
    // $post=Posts::onlyTrashed()->where('is_admin', 0)->get();
    foreach($post as $post) {
        echo $post . "<br>"; //return only trashed items
    }
});

/*
 * restore trashed itmes
 */

Route::get('/restore', function(){
    Posts::onlyTrashed()->restore();
    // or
    // Posts::withTrashed()->restore();
});

/*
 * delete record permanently
 */

Route::get('/forcedelete', function(){
   Posts::onlyTrashed()->forcedelete();
});
