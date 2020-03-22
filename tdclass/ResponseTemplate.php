<?php

namespace TDClass;

class ResponseTemplate {

    private $error = 0;
    private $message = [];
    private $messageType = [];
    private $data = [];
    private $pagination = 0;
    private $maxDataSize = null;
    private $resourceName = "Recurso";
    private $resourceMessage = "Resposta de erro do recurso.";
    private $reload = false;
    
    function __construct () {
    }
    // countTable
    /**
     * @* @param int $error Error code
     * @* @param array $data Requested data
     * @* @param int $offset Pagination offset
     */
    public function build ( int $error, array $data = [] ) {
        $this->setMessage( [
            0 => "Operação realizada com sucesso.",
            1 => $this->getResourceName() . " não encontrado.",
            2 => $this->getResourceMessage(),
            3 => "Senha de acesso inválida.",
            4 => "Operação interrompida. Já existe uma instalação anterior."
        ] );
        $this->setMessageType( [
            0 => "success",
            1 => "danger",
            2 => "warning",
            3 => "danger",
            4 => "danger"
        ] );
        // 
        if ( array_key_exists( $error, $this->message ) ) {
            $this->setError( $error );
            return [
                "error" => $this->getError(),
                "message" => $this->getMessage( $this->getError() ),
                "messageType" => $this->getMessageType( $this->getError() ),
                "data" => $data,
                "dataLenght" => count( $data ),
                "maxDataSize" => $this->getMaxDataSize(),
                "page" => $this->getPagination(),
                "reload" => $this->reload
            ];
        }
        return false;
    }

    /**
     * @* @param int $error Error code
     */
    public function setError ( int $error ) {
        $this->error = $error;
    }
    public function getError () {
        return $this->error;
    }

    /**
     * @* @param array $messageType Error (or success) messageType
     */
    public function setMessageType ( array $messageType ) {
        $this->messageType = $messageType;
    }
    public function getMessageType ( int $error ) {
        return $this->messageType[ $error ];
    }

    /**
     * @* @param array $message Error (or success) message
     */
    public function setMessage ( array $message ) {
        $this->message = $message;
    }
    public function getMessage ( int $error ) {
        return $this->message[ $error ];
    }

    /**
     * @* @param string $resourceName Error (or success) resourceName
     */
    public function setResourceName ( string $resourceName ) {
        $this->resourceName = $resourceName;
    }
    public function getResourceName () {
        return $this->resourceName;
    }

    /**
     * @* @param string $resourceMessage Error (or success) resourceMessage
     */
    public function setResourceMessage ( string $resourceMessage ) {
        $this->resourceMessage = $resourceMessage;
    }
    public function getResourceMessage () {
        return $this->resourceMessage;
    }

    /**
     * @* @param int $pagination Pagination per Page integer
     */
    public function setPagination ( int $pagination ) {
        $this->pagination = $pagination;
    }
    public function getPagination () {
        return $this->pagination;
    }

    /**
     * @* @param int $pagination MaxDataSize per Page integer
     */
    public function setMaxDataSize ( int $maxDataSize ) {
        $this->maxDataSize = $maxDataSize;
    }
    public function getMaxDataSize () {
        return $this->maxDataSize;
    }

    public function forceReload () {
        $this->reload = true;
    }

}


?>