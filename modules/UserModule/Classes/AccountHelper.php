<?php

namespace UserModule\Classes;

class AccountHelper
{

    protected $uploadPath;
    protected $galleryStorage;
    protected $videoStorage;
    protected $musicStorage;

    public function __construct()
    {

    }

    public function setVideoStorage($s)
    {
        $this->videoStorage = $s;
    }

    public function setMusicStorage($s)
    {
        $this->musicStorage = $s;
    }

    public function setGalleryStorage($s)
    {
        $this->galleryStorage = $s;
    }

    public function setUploadPath($path)
    {
        $this->uploadPath = $path;
    }

    public function normaliseFileName($userID, $fileName, $skipTimestamp = null)
    {
        $fileName = strtolower(str_replace(' ', '_', $fileName));
        if ($skipTimestamp === null || $skipTimestamp === false) {
            $fileName = md5(openssl_random_pseudo_bytes(5)) . '_' . $fileName;
        }
        $fileName = $userID . '_' . $fileName;

        return $fileName;
    }

    /**
     * Create a new gallery item, create its file on disk and insert it into the DB
     *
     * @param integer $userID
     * @param object  $file
     *
     * @return integer
     */
    public function createGalleryItem($userID, $file)
    {
        $fileName = $this->normaliseFileName($userID, $file->getClientOriginalName());
        $file->move($this->uploadPath, $fileName);

        /*
         * Check if user have any existing picture,
         * if not, set featured = 1.
         */

        $featured = $this->galleryStorage->hasPictures($userID) ? 1 : 0;
        return $this->galleryStorage->create(
            array(
                 'user_id'   => $userID,
                 'file_name' => $fileName,
                 'featured'  => $featured
            )
        );
    }

}