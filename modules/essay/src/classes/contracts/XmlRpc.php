<?php namespace Essay\Classes\Contracts;

use Illuminate\Http\Request;

interface XmlRpc
{
	public function on(Request $request);

	public function errorMessage();

	public function authenticate($email, $password);

	public function getUsersBlogs($params);

	public function editPost($params);

	public function getCategories($params);

	public function getPost($params);

	public function getRecentPosts($params);

	public function newMediaObject($params);

	public function newPost($params);

	public function newCategory($params);

	public function deletePost($params);
}