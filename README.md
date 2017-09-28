[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/500px/functions?utm_source=RapidAPIGitHub_500pxFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# 500px Package
500px API provides programmatic access to 500px functionality and content.
* Domain: [500px](http://500px.com/)
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Browse to [500px website](https://500px.com)
1. Register or log in
2. Create new application at [Application page](https://500px.com/settings/applications)



## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## 500px.getRequestToken
Step 1 of OAuth authorization

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API key
| apiSecret| credentials| Your API secret

## 500px.getAccessToken
Step 2 of OAuth authorization

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The requestToken obtained from previous step
| tokenSecret| String     | The requestTokenSecret obtainedfrom previous step 
| username   | String     | Username of the user
| password   | String     | Pasword of the user

## 500px.listPhotos
Returns a listing of twenty (up to one hundred) photos for a specified photo stream.

| Field                 | Type       | Description
|-----------------------|------------|----------
| apiKey                | credentials| Your API key
| apiSecret             | credentials| Your API secret
| token                 | String     | The oauthToken obtained
| tokenSecret           | String     | The tokenSecret obtained
| feature               | Select     | Photo stream to be retrieved. Default fresh_today. All per-user streams require a user_id parameter
| userIds               | List       | Id of the user
| includeCategories     | List       | Categories to return photos from
| excludeCategories     | List       | Exclude categories to return photos from
| sort                  | Select     | Sort photos in the specified order.
| sortDirection         | Select     | Control the order of the sorting. You can provide a sortDirection without providing a sort, in which case the default sort for the requested feature will be adjusted.
| page                  | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage               | Number     | The number of results to return. Can not be over 100, default 20.
| imageSize             | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| includeStore          | Select     | If set to 1, returns market infomation about the photo.
| includeStates         | Select     | If set to 1, returns state of the photo for the currently logged in user and authenticated request.
| personalizedCategories| Select     |  If set to true, returns photos from personalized categories for the currently logged in user and authenticated request, if personalization is available for the current user.
| tags                  | Select     | If set to 1, returns an array of tags for the photo.

```
Global features

'popular' — Return photos in Popular. Default sort: rating.
'highest_rated' — Return photos that have been in Popular. Default sort: highest_rating.
'upcoming' — Return photos in Upcoming. Default sort: time when Upcoming was reached.
'editors' — Return photos in Editors' Choice. Default sort: time when selected by an editor.
'fresh_today' — Return photos in Fresh Today. Default sort: time when reached fresh.
'fresh_yesterday' — Return photos in Fresh Yesterday. Default sort: same as 'fresh_today'.
'fresh_week' — Return photos in Fresh This Week. Default sort: same as 'fresh_today'.

Per-user features

All per-user streams require a user_id or username parameter

'user' - Return photos of a user, additional parameter 'user_id' or 'username' is required. Default sort: time uploaded.
'user_friends' — Return photos by users the specified user is following. Default sort: time uploaded.
```
```
ID	Category
0	Uncategorized
10	Abstract
29	Aerial New!
11	Animals
5	Black and White
1	Celebrities
9	City and Architecture
15	Commercial
16	Concert
20	Family
14	Fashion
2	Film
24	Fine Art
23	Food
3	Journalism
8	Landscapes
12	Macro
18	Nature
30	Night New!
4	Nude
7	People
19	Performing Arts
17	Sport
6	Still Life
21	Street
26	Transportation New!
13	Travel
22	Underwater
27	Urban Exploration New!
25	Wedding New!
```

## 500px.searchPhotosByTerm
Returns a listing of twenty (up to one hundred) photos from search results for a specified term

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| Your API key
| apiSecret        | credentials| Your API secret
| token            | String     | The oauthToken obtained
| tokenSecret      | String     | The tokenSecret obtained
| term             | String     | A keyword to search for.
| includeCategories| List       | Categories to return photos from
| feature          | Select     | Search only certain feature categories
| excludeCategories| List       | Exclude categories to return photos from
| excludeNude      | Select     | Specifically exclude all photos marked as NSFW
| page             | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage          | Number     | The number of results to return. Can not be over 100, default 20.
| tags             | Select     | If set to 1, returns an array of tags for the photo.
| userId           | String     | Limit your search within photos of the given user.
| imageSize        | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| licenseTypes     | List       | [Types of licenses](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#license-types)
| sort             | Select     | Sort photos in the specified order.

```
ID	Category
0	Uncategorized
10	Abstract
29	Aerial New!
11	Animals
5	Black and White
1	Celebrities
9	City and Architecture
15	Commercial
16	Concert
20	Family
14	Fashion
2	Film
24	Fine Art
23	Food
3	Journalism
8	Landscapes
12	Macro
18	Nature
30	Night New!
4	Nude
7	People
19	Performing Arts
17	Sport
6	Still Life
21	Street
26	Transportation New!
13	Travel
22	Underwater
27	Urban Exploration New!
25	Wedding New!
```

## 500px.searchPhotosByTag
Returns a listing of twenty (up to one hundred) photos from search results for a specified tag

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| Your API key
| apiSecret        | credentials| Your API secret
| token            | String     | The oauthToken obtained
| tokenSecret      | String     | The tokenSecret obtained
| tag              | String     | A complete tag string to search for.
| includeCategories| List       | Categories to return photos from
| feature          | Select     | Search only certain feature categories
| excludeCategories| List       | Exclude categories to return photos from
| excludeNude      | Select     | Specifically exclude all photos marked as NSFW
| page             | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage          | Number     | The number of results to return. Can not be over 100, default 20.
| tags             | Select     | If set to 1, returns an array of tags for the photo.
| userId           | String     | Limit your search within photos of the given user.
| imageSize        | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| licenseTypes     | List       | [Types of licenses](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#license-types)
| sort             | Select     | Sort photos in the specified order.

```
ID	Category
0	Uncategorized
10	Abstract
29	Aerial New!
11	Animals
5	Black and White
1	Celebrities
9	City and Architecture
15	Commercial
16	Concert
20	Family
14	Fashion
2	Film
24	Fine Art
23	Food
3	Journalism
8	Landscapes
12	Macro
18	Nature
30	Night New!
4	Nude
7	People
19	Performing Arts
17	Sport
6	Still Life
21	Street
26	Transportation New!
13	Travel
22	Underwater
27	Urban Exploration New!
25	Wedding New!
```

## 500px.searchPhotosByGeo
Returns a listing of twenty (up to one hundred) photos from search results for a specified geo

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| Your API key
| apiSecret        | credentials| Your API secret
| token            | String     | The oauthToken obtained
| tokenSecret      | String     | The tokenSecret obtained
| geo              | Map        | A geo-location point of the format latitude,longitude
| radius           | String     | A geo-location point radius
| units            | Select     | Radius units
| includeCategories| List       | Categories to return photos from
| feature          | Select     | Search only certain feature categories
| excludeCategories| List       | Exclude categories to return photos from
| excludeNude      | Select     | Specifically exclude all photos marked as NSFW
| page             | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage          | Number     | The number of results to return. Can not be over 100, default 20.
| tags             | Select     | If set to 1, returns an array of tags for the photo.
| userId           | String     | Limit your search within photos of the given user.
| imageSize        | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| licenseTypes     | List       | [Types of licenses](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#license-types)
| sort             | Select     | Sort photos in the specified order.

```
ID	Category
0	Uncategorized
10	Abstract
29	Aerial New!
11	Animals
5	Black and White
1	Celebrities
9	City and Architecture
15	Commercial
16	Concert
20	Family
14	Fashion
2	Film
24	Fine Art
23	Food
3	Journalism
8	Landscapes
12	Macro
18	Nature
30	Night New!
4	Nude
7	People
19	Performing Arts
17	Sport
6	Still Life
21	Street
26	Transportation New!
13	Travel
22	Underwater
27	Urban Exploration New!
25	Wedding New!
```

## 500px.getSinglePhoto
Returns detailed information of a single photo.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| photoId     | String     | Id of the photo
| imageSize   | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| comments    | Select     | Return comments to the photo in the response. Comments are returned in order of creation, 20 entries per page. If omitted no comments will be returned, if present comments will be returned.
| commentsPage| Number     | Return the specified page from the comments listing. Page numbers are 1-based.
| tags        | Select     | If set to 1, returns an array of tags for the photo.

## 500px.listPhotoComments
Returns a listing of twenty comments for the photo.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| photoId     | String     | Id of the photo
| nested      | Select     | Include this parameter to return the comments in nested format.
| commentsPage| Number     | Return the specified page from the comments listing. Page numbers are 1-based.

## 500px.listPhotoVotes
Returns all users that had liked this photo.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo
| page       | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage    | Number     | The number of results to return. Can not be over 100, default 20.

## 500px.updatePhoto
Allows the client application to update user-editable information on a photo.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| photoId     | String     | Id of the photo
| name        | String     | Title of the photo, up to 255 characters in length.
| description | String     | Text description of the photo, up to 65535 characters in length.
| category    | Select     | [Category of the photo](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#categories)
| tags        | List       | List of tags applicable to this photo.
| addTags     | List       | list of tags to add to this photo's existing tags.
| removeTags  | List       | list of tags to remove from this photo's existing tags.
| shutterSpeed| String     | Shutter speed value for the photo, internally stored as string.
| focalLength | String     | Focal length value for the photo, internally stored as string.
| aperture    | String     | Aperture value value for the photo, internally stored as string.
| iso         | String     | Integer ISO value for the photo.
| camera      | String     | Make and model of the camera used to take this photo.
| lens        | String     | Information about the lens used to take this photo.
| coordinates | Map        | Location this photo was taken at
| nsfw        | Select     | Boolean value indicating that the photo may contain not-safe-for-work content or content not suitable for minors.
| licenseTypes| Select     | [Types of licenses](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#license-types)
| privacy     | Select     | Integer value indicating that the photo should be shown (0) or hidden (1) on the user's profile.
| crop        | String     | A hash containing keys x, x2, y, y2 and representing coordinates within which the thumbnail must be cropped. The crop is made using the top left corner as the origin. 

## 500px.addPhoto
Create a new photo on behalf of the user, and receive an upload key in exchange.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| name        | String     | Title of the photo, up to 255 characters in length.
| description | String     | Text description of the photo, up to 65535 characters in length.
| category    | Select     | [Category of the photo](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#categories)
| tags        | List       | List of tags applicable to this photo.
| shutterSpeed| String     | Shutter speed value for the photo, internally stored as string.
| focalLength | String     | Focal length value for the photo, internally stored as string.
| aperture    | String     | Aperture value value for the photo, internally stored as string.
| iso         | String     | Integer ISO value for the photo.
| camera      | String     | Make and model of the camera used to take this photo.
| lens        | String     | Information about the lens used to take this photo.
| coordinates | Map        | Location this photo was taken at
| privacy     | Select     | Integer value indicating that the photo should be shown (0) or hidden (1) on the user's profile.

## 500px.uploadPhoto
Upload a photo

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| token       | String     | The oauthToken obtained
| uploadKey   | String     | Upload key received in the response to addPhoto
| photoId     | String     | The ID of the photo the file is being uploaded for
| file        | File       | Photo file
| name        | String     | Title of the photo, up to 255 characters in length.
| description | String     | Text description of the photo, up to 65535 characters in length.
| category    | Select     | [Category of the photo](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#categories)
| shutterSpeed| String     | Shutter speed value for the photo, internally stored as string.
| focalLength | String     | Focal length value for the photo, internally stored as string.
| aperture    | String     | Aperture value value for the photo, internally stored as string.
| iso         | String     | Integer ISO value for the photo.
| camera      | String     | Make and model of the camera used to take this photo.
| lens        | String     | Information about the lens used to take this photo.
| coordinates | Map        | Location this photo was taken at
| privacy     | Select     | Integer value indicating that the photo should be shown (0) or hidden (1) on the user's profile.
| crop        | String     | A hash containing keys x, x2, y, y2 and representing coordinates within which the thumbnail must be cropped. The crop is made using the top left corner as the origin. 

## 500px.addVote
Allows the user to vote for a photo.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo
| vote       | Select     | Values: '0' for 'dislike' or '1' for 'like'.

## 500px.deleteVote
Unlikes the specified photo for the user.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo

## 500px.addTags
Adds tags to the photo.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo
| tags       | List       | List of tags to add to this photo

## 500px.addComment
Creates a new comment for the photo.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo
| body       | String     | Id of the photo

## 500px.reportPhoto
Allows to report a photo.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your API key
| apiSecret    | credentials| Your API secret
| token        | String     | The oauthToken obtained
| tokenSecret  | String     | The tokenSecret obtained
| photoId      | String     | Id of the photo
| reason       | Select     |  Reason for the report '1' — Offensive (rude, obscene) '2' — Spam (ads, self-promotion) '3' — Offtopic (trolling) '4' — Copyright (plagiarism, stealing) '5' — Wrong content (illustration, 3D) '6' — Should be tagged as adult content
| reasonDetails| String     | Additional information about the report, as a text blob

## 500px.deletePhoto
Deletes the photo from the User's library.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo

## 500px.deleteTags
Removes tags from the photo. 

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| photoId    | String     | Id of the photo
| tags       | List       | List of tags to add to this photo

## 500px.getMyInfo
Returns the profile information for the current user.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained

## 500px.getUserinfoById
Return information for the specified user ID.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user

## 500px.getUserinfoByUsername
Return information for the specified username.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| username   | String     | Username of the user

## 500px.getUserinfoByEmail
Return information for the specified email.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| email      | String     | Email of the user

## 500px.listUserFriends
Returns a list of friends for the specified user.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| page       | Number     | Return the specified page of the resource. Page numbering is 1-based..
| perPage    | Number     | The number of results to return. Can not be over 100, default 20.

## 500px.listUserFollowers
Returns a list of users who follow the specified user.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| page       | Number     | Return the specified page of the resource. Page numbering is 1-based..
| perPage    | Number     | The number of results to return. Can not be over 100, default 20.

## 500px.searchUsers
Return listing of ten (up to one hundred) users from search results for a specified search term.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| term       | String     | A keyword to search for.

## 500px.addFriend
Add the user to the list of followers.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user

## 500px.deleteFriend
Removes the user from the list of followers.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user

## 500px.listGalleries
Returns a listing of twenty (up to one hundred) galleries for the given user.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your API key
| apiSecret    | credentials| Your API secret
| token        | String     | The oauthToken obtained
| tokenSecret  | String     | The tokenSecret obtained
| userId       | String     | ID of the user
| sort         | Select     | Sort galleries in the specified order.
| includeCover | Select     | If 1, the user's cover is included.
| page         | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage      | Number     | The number of results to return. Can not be over 100, default 20.
| coverSize    | Number     | The cover photo size to be returned, if include_cover is set. Defaults to 4.
| sortDirection| Select     | Control the order of the sorting. You can provide a sortDirection without providing a sort, in which case the default sort for the requested feature will be adjusted.
| privacy      | Select     | The privacy level of the galleries to return.
| kinds        | List       | List of [gallery kinds](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#gallery-kinds).

## 500px.getGalleryById
Returns the details of the requested gallery

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery

## 500px.getGalleryByPath
Returns the details of the requested gallery

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryPath| String     | Path of the gallery

## 500px.getGalleryByToken
Returns the details of the requested gallery

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| userId      | String     | Id of the user
| galleryToken| String     | TOken of the gallery

## 500px.listGalleryPhotos
Returns a listing of twenty (up to one hundred) photos in the given gallery.

| Field            | Type       | Description
|------------------|------------|----------
| apiKey           | credentials| Your API key
| apiSecret        | credentials| Your API secret
| token            | String     | The oauthToken obtained
| tokenSecret      | String     | The tokenSecret obtained
| userId           | String     | Id of the user
| galleryId        | String     | Id of the gallery
| includeCategories| List       | Categories to return photos from
| excludeCategories| List       | Exclude categories to return photos from
| sort             | Select     | Sort photos in the specified order.
| sortDirection    | Select     | Control the order of the sorting. You can provide a sortDirection without providing a sort, in which case the default sort for the requested feature will be adjusted.
| page             | Number     | Return a specific page in the photo stream. Page numbering is 1-based.
| perPage          | Number     | The number of results to return. Can not be over 100, default 20.
| imageSize        | Select     | The photo size(s) to be returned. [list of formats](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#image-urls-and-image-sizes)
| includeStore     | Select     | If set to 1, returns market infomation about the photo.
| includeStates    | Select     | If set to 1, returns state of the photo for the currently logged in user and authenticated request.
| includeTags      | Select     |  If set to 1, returns an array of tags for the photo.
| includeMissing   | Select     | If set to 1, returns ids of photos that have been deleted, made private or the owner of the photo is deactivated.
| includeGeo       | Select     | If set to 1, returns location information about the photo.
| includeLicensing | Select     | If set to 1, returns licensing information for the photo.

```
ID	Category
0	Uncategorized
10	Abstract
29	Aerial New!
11	Animals
5	Black and White
1	Celebrities
9	City and Architecture
15	Commercial
16	Concert
20	Family
14	Fashion
2	Film
24	Fine Art
23	Food
3	Journalism
8	Landscapes
12	Macro
18	Nature
30	Night New!
4	Nude
7	People
19	Performing Arts
17	Sport
6	Still Life
21	Street
26	Transportation New!
13	Travel
22	Underwater
27	Urban Exploration New!
25	Wedding New!
```

## 500px.getGalleryShareUrl
Returns a sharable private URL for the given gallery.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery

## 500px.updateGallery
Updates the metadata for the given gallery.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API key
| apiSecret   | credentials| Your API secret
| token       | String     | The oauthToken obtained
| tokenSecret | String     | The tokenSecret obtained
| userId      | String     | Id of the user
| galleryId   | String     | Id of the gallery
| name        | String     | Title of the gallery, up to 255 characters in length.
| description | String     | Text description of the photo, up to 65535 characters in length.
| subtitle    | String     | Updates the subtitle of the gallery.
| privacy     | Select     | If 1, the gallery is marked private, otherwise it is public.
| coverPhotIid| String     | Updates the gallery's cover photo, must be a pre-existing item in the gallery with valid photo and user.
| customPath  | String     | A slug that the gallery will be accessible through. Needs to be unique to the user.

## 500px.addPhotosAfter
Adds photos after photo

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery
| addAfter   | String     | Id of the photo
| photos     | List       | list of photo to add

## 500px.addPhotosBefore
Adds photos before photo

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery
| addBefore  | String     | Id of the photo
| photos     | List       | list of photo to add

## 500px.removePhotos
Remove photos

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery
| photos     | List       | list of photo to remove

## 500px.repositionGalleries
Reposition galleries

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| beforeId   | String     | The id of another gallery to position the galleries before
| afterId    | String     | The id of another gallery to position the galleries after
| galleries  | List       | list of galleries to reposition

## 500px.addGallery
Creates a new, empty gallery owned by the given user.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| name       | String     | Title of the gallery, up to 255 characters in length.
| description| String     | Text description of the photo, up to 65535 characters in length.
| subtitle   | String     | Updates the subtitle of the gallery.
| privacy    | Select     | If 1, the gallery is marked private, otherwise it is public.
| customPath | String     | A slug that the gallery will be accessible through. Needs to be unique to the user.
| kind       | Select     | List of [gallery kinds](https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#gallery-kinds).

## 500px.deleteGallery
Deletes the gallery.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| userId     | String     | Id of the user
| galleryId  | String     | Id of the gallery

## 500px.replyComment
Creates a reply to an existing comment. 

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API key
| apiSecret  | credentials| Your API secret
| token      | String     | The oauthToken obtained
| tokenSecret| String     | The tokenSecret obtained
| commentId  | String     | Id of the comment
| body       | String     | Body of the comment

