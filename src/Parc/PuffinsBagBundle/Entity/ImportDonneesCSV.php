<?php

namespace Parc\PuffinsBagBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
//use Doctrine\ORM\Mapping as ORM;@ORM\Entity @ORM\GeneratedValue(strategy="AUTO")
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ImportDonneesCSV
 *
 * 
 */
class ImportDonneesCSV
{
	/**
	* 
	*/
	protected $id;
	
	/**
    * @Assert\File(
	*	maxSize = "500k",
	*	mimeTypes = {"text/csv", "application/csv", "text/comma-separated-values", "text/plain"} , 
	*	mimeTypesMessage = "Choisissez un fichier CSV valide" )
    */
    protected $fichierCSV;

    /**
     * Set fichierCSV
     *
     * @param $fichierCSV
     * @return fichierCSV
     */
    public function setFichierCSV(File $file)
    {
        $this->fichierCSV = $file;
    }

    /**
     * Get fichierCSV
     *
     * @return fichierCSV 
     */
    public function getFichierCSV()
    {
        return $this->fichierCSV;
    }
}
