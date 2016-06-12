<?php

	class Ldap  {

	/*
	|--------------------------------------------------------------------------
	| Login and get info about user on successfull login from ldap
	|--------------------------------------------------------------------------
	*/

		public $attr = [];
		public $user = [];

		public function __construct( $server, $attr ){

			$this->attr['email'] 	= $attr['email'];
		 	$this->attr['password'] = $attr['password'];

			$this->attr['dc'] = 	ldap_connect( $server ) or die( "Can't connect to LDAP Server" );
									ldap_set_option( $this->attr['dc'], LDAP_OPT_PROTOCOL_VERSION, 3 );
									ldap_set_option( $this->attr['dc'], LDAP_OPT_REFERRALS, 0 );

		}

		public function isCredentialsCorrect( array $attr = [] ){

		 	if ( @ldap_bind( $this->attr['dc'], $this->attr['email'], $this->attr['password'] ) )
		 	{
		 		$login 			= substr( $this->attr['email'], 0, strpos( $this->attr['email'], "@") );
		 		$search_filter	= "(&(objectCategory=person)(sAMAccountName=$login))";

		 		if ( $ldap_search_result = ldap_search( $this->attr['dc'], $this->getDnFromEmail( $this->attr['email'] ), $search_filter ) )
		 		{
					$this->user = @ldap_get_entries( $this->attr['dc'], $ldap_search_result )[0];
				}
				ldap_unbind( $this->attr['dc'] );
		 		return true;

		 	}

		}



		// helpers
		private function getDnFromEmail($email){
			$domain	= substr( $email, strpos( $email, "@") );
			$dn = str_replace( '.', ',dc=', $domain );
			$dn = str_replace( '@', 'dc=', $dn );
			return $dn;
		}

	} // class