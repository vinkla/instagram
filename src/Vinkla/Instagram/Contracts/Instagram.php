<?php namespace Vinkla\Instagram\Contracts;

/**
 * Instagram API class
 *
 * API Documentation: http://instagram.com/developer/
 * Class Documentation: https://github.com/cosenary/Instagram-PHP-API
 *
 * @author Christian Metz
 * @since 30.10.2011
 * @copyright Christian Metz - MetzWeb Networks 2011-2014
 * @version 2.2
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */
interface Instagram {

 /**
  * Generates the OAuth login URL
  *
  * @param array [optional] $scope       Requesting additional permissions
  * @return string                       Instagram OAuth login URL
  */
 public function getLoginUrl($scope = ['basic']);

 /**
  * Search for a user
  *
  * @param string $name Instagram username
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function searchUser($name, $limit = 0);

 /**
  * Get user info
  *
  * @param integer [optional] $id        Instagram user ID
  * @return mixed
  */
 public function getUser($id = 0);

 /**
  * Get user activity feed
  *
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getUserFeed($limit = 0);

 /**
  * Get user recent media
  *
  * @param integer [optional] $id        Instagram user ID
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getUserMedia($id = 'self', $limit = 0);

 /**
  * Get the liked photos of a user
  *
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getUserLikes($limit = 0);

 /**
  * Get the list of users this user follows
  *
  * @param integer [optional] $id        Instagram user ID
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getUserFollows($id = 'self', $limit = 0);

 /**
  * Get the list of users this user is followed by
  *
  * @param integer [optional] $id        Instagram user ID
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getUserFollower($id = 'self', $limit = 0);

 /**
  * Get information about a relationship to another user
  *
  * @param integer $id Instagram user ID
  * @return mixed
  */
 public function getUserRelationship($id);

 /**
  * Modify the relationship between the current user and the target user
  *
  * @param string $action Action command (follow/unfollow/block/unblock/approve/deny)
  * @param integer $user Target user ID
  * @return mixed
  */
 public function modifyRelationship($action, $user);

 /**
  * Search media by its location
  *
  * @param float $lat Latitude of the center search coordinate
  * @param float $lng Longitude of the center search coordinate
  * @param integer [optional] $distance  Distance in metres (default is 1km (distance=1000), max. is 5km)
  * @param long [optional] $minTimestamp Media taken later than this timestamp (default: 5 days ago)
  * @param long [optional] $maxTimestamp Media taken earlier than this timestamp (default: now)
  * @return mixed
  */
 public function searchMedia($lat, $lng, $distance = 1000, $minTimestamp = null, $maxTimestamp = null);

 /**
  * Get media by its id
  *
  * @param integer $id Instagram media ID
  * @return mixed
  */
 public function getMedia($id);

 /**
  * Get the most popular media
  *
  * @return mixed
  */
 public function getPopularMedia();

 /**
  * Search for tags by name
  *
  * @param string $name Valid tag name
  * @return mixed
  */
 public function searchTags($name);

 /**
  * Get info about a tag
  *
  * @param string $name Valid tag name
  * @return mixed
  */
 public function getTag($name);

 /**
  * Get a recently tagged media
  *
  * @param string $name Valid tag name
  * @param integer [optional] $limit     Limit of returned results
  * @return mixed
  */
 public function getTagMedia($name, $limit = 0);

 /**
  * Get a list of users who have liked this media
  *
  * @param integer $id Instagram media ID
  * @return mixed
  */
 public function getMediaLikes($id);

 /**
  * Get a list of comments for this media
  *
  * @param integer $id Instagram media ID
  * @return mixed
  */
 public function getMediaComments($id);

 /**
  * Add a comment on a media
  *
  * @param integer $id Instagram media ID
  * @param string $text Comment content
  * @return mixed
  */
 public function addMediaComment($id, $text);

 /**
  * Remove user comment on a media
  *
  * @param integer $id Instagram media ID
  * @param string $commentID User comment ID
  * @return mixed
  */
 public function deleteMediaComment($id, $commentID);

 /**
  * Set user like on a media
  *
  * @param integer $id Instagram media ID
  * @return mixed
  */
 public function likeMedia($id);

 /**
  * Remove user like on a media
  *
  * @param integer $id Instagram media ID
  * @return mixed
  */
 public function deleteLikedMedia($id);

 /**
  * Get information about a location
  *
  * @param integer $id Instagram location ID
  * @return mixed
  */
 public function getLocation($id);

 /**
  * Get recent media from a given location
  *
  * @param integer $id Instagram location ID
  * @return mixed
  */
 public function getLocationMedia($id);

 /**
  * Get recent media from a given location
  *
  * @param float $lat Latitude of the center search coordinate
  * @param float $lng Longitude of the center search coordinate
  * @param integer [optional] $distance  Distance in meter (max. distance: 5km = 5000)
  * @return mixed
  */
 public function searchLocation($lat, $lng, $distance = 1000);

 /**
  * Pagination feature
  *
  * @param object $obj Instagram object returned by a method
  * @param integer $limit Limit of returned results
  * @return mixed
  */
 public function pagination($obj, $limit = 0);

 /**
  * Get the OAuth data of a user by the returned callback code
  *
  * @param string $code OAuth2 code variable (after a successful login)
  * @param boolean [optional] $token     If it's true, only the access token will be returned
  * @return mixed
  */
 public function getOAuthToken($code, $token = false);

 /**
  * Access Token Setter
  *
  * @param object|string $data
  * @return void
  */
 public function setAccessToken($data);

 /**
  * Access Token Getter
  *
  * @return string
  */
 public function getAccessToken();

 /**
  * API-key Setter
  *
  * @param string $apiKey
  * @return void
  */
 public function setApiKey($apiKey);

 /**
  * API Key Getter
  *
  * @return string
  */
 public function getApiKey();

 /**
  * API Secret Setter
  *
  * @param string $apiSecret
  * @return void
  */
 public function setApiSecret($apiSecret);

 /**
  * API Secret Getter
  *
  * @return string
  */
 public function getApiSecret();

 /**
  * API Callback URL Setter
  *
  * @param string $apiCallback
  * @return void
  */
 public function setApiCallback($apiCallback);

 /**
  * API Callback URL Getter
  *
  * @return string
  */
 public function getApiCallback();

 /**
  * Enforce Signed Header
  *
  * @param boolean $signedHeader
  * @return void
  */
 public function setSignedHeader($signedHeader);
}
