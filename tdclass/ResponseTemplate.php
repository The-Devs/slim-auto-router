<?php

namespace TDClass;

use Exception;

class ResponseTemplate {

    private $status;
	private $message = [
		200 => "Ok.",
		201 => "Criado com sucesso.",
		301 => "Redirecionado permanentemente.",
		403 => "Acesso negado.",
		404 => "Não encontrado.",
		500 => "Erro interno do servidor."
	];
    private $data = null;
	private $links = [ "self" => "" ];
    
    function __construct ( int $status ) {
		if ( ! in_array( $status, array_keys( $this->message ), true ) )
			throw new Exception( "O status HTTP deve ser um entre os seguintes: [" . implode( ", ", array_keys( $this->message ) ) . "]." );

		$this->status = $status;
    }
    /**
     * @* @param int $status Error code
     * @* @param array $data Requested data
     * @* @param int $offset Pagination offset
     */
    public function build ( array $data = null ) {
		if ( ! $this->isLinkValid( "self" ) )
			// throw new Exception( "A propriedade \"self\" deve possuir um URL definida em links." );

		$links = [];
		foreach ( $this->links as $key => $value )
		{
			if ( $this->isLinkValid( $key ) )
				$links[ $key ] = $value;
		}
		return [
			"status" => $this->status,
			"message" => $this->getMessage(),
			"data" => $data,
			"links" => $links,
		];
    }

    public function getMessage () {
        return $this->message[ $this->status ];
    }

	public function setLink( string $key, string $value ) {
		$this->links[ $key ] = $value;
	}
	public function setLinks( array $links ) {
		foreach ( $links as $key => $value )
		{
			$this->setLink( $key, $value );
		}
	}
	private function isLinkValid ( string $key ) {
		return ! empty( $this->links[ $key ] );
	}
}

?>
