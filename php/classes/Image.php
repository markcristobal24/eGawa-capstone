<?php
require_once dirname(__FILE__) . "/../../vendor/autoload.php";

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class Image
{
    public function upload_image($image, $name, $directory)
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => 'dm6aymlzm',
                'api_key' => '615549315816694',
                'api_secret' => 'YPGWjYb29Jw_0j98exYn6KqZXfk'
            ],

            'url' => [
                'secure' => true
            ]
        ]);

        $data = (new UploadApi())->upload(
            $image,
            [
                'folder' => $directory,
                'public_id' => $name,
                'overwrite' => true,
            ],
        );

        return $data;
    }
}
?>