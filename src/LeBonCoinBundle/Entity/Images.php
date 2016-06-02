<?php

namespace LeBonCoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Images
 *
 * @ORM\Table(name="images", indexes={@ORM\Index(name="fk_images_adverts1_idx", columns={"adverts_id"})})
 * @ORM\Entity
 */
class Images
{
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \LeBonCoinBundle\Entity\Adverts
     *
     * @ORM\ManyToOne(targetEntity="LeBonCoinBundle\Entity\Adverts", inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adverts_id", referencedColumnName="id")
     * })
     */
    private $adverts;

    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Images
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adverts
     *
     * @param \LeBonCoinBundle\Entity\Adverts $adverts
     *
     * @return Images
     */
    public function setAdverts(\LeBonCoinBundle\Entity\Adverts $adverts = null)
    {
        $this->adverts = $adverts;

        return $this;
    }

    /**
     * Get adverts
     *
     * @return \LeBonCoinBundle\Entity\Adverts
     */
    public function getAdverts()
    {
        return $this->adverts;
    }
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        $this->url = $this->file->getClientOriginalName();
        
        $this->file->move($this->getUploadRootDir(), $this->url);
    }

    public function getUploadDir()
    {
        return 'bundles/leboncoin/img';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
}
