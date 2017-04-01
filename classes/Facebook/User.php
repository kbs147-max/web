<?php
require_once ('/classes/facebook/facebook.php');
class user
{
    public $id;
    public $name;
    public $birthday;
    public $gender;
    public $link;
	public $friends = array();
	public $access_token;
   
    public function __construct($accessToken)
    {
        $url = 'https://graph.facebook.com/me';
        $params = array(
            "fields" => "id,link,birthday,name,gender,friends{name,id}",
            "access_token" => $accessToken
        );
        $data = Facebook::cURL('get', $url, $params);

        $this->id       = $data['id'];
        $this->name     = $data['name'];
        $this->birthday = $data['birthday'];
		$this->link     = $data['link'];
		$this->friends  = $data['friends']['data'];
        $this->gender   = $data['gender'];
        $this->access_token = $accessToken;
    }
    public function getFriends()
    {
        return $this->friends;
    }
    public function getUserLink()
    {
        return $this->link;
    }

    public function getFullName()
    {
        return $this->name;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getID()
    {
        return $this->id;
    }
}
?>