<?php

namespace Application\Entity;

class Lugar
{

    protected $id;
    protected $nombre;
    protected $calle;
    protected $numero;
    protected $colonia;
    protected $ciudad;
    protected $estado;
    protected $pais;
    protected $codigo_postal;
    protected $lat;
    protected $lng;
    protected $tipo;
    protected $observaciones;
    protected $status;
    protected $created_at;
    protected $modified_at;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function toArray()
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    /**
     * @param null $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return null
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param null $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return null
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param null $codigo_postal
     */
    public function setCodigoPostal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;
    }

    /**
     * @return null
     */
    public function getCodigoPostal()
    {
        return $this->codigo_postal;
    }

    /**
     * @param null $colonia
     */
    public function setColonia($colonia)
    {
        $this->colonia = $colonia;
    }

    /**
     * @return null
     */
    public function getColonia()
    {
        return $this->colonia;
    }

    /**
     * @param null $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param null $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return null
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $modified_at
     */
    public function setModifiedAt($modified_at)
    {
        $this->modified_at = $modified_at;
    }

    /**
     * @return null
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * @param null $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param null $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return null
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param null $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return null
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param null $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * @return null
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return null
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

}