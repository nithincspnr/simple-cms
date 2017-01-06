<?php
/**
 * source : https://code.tutsplus.com/tutorials/how-to-paginate-data-with-php--net-2928
 * createLinks method customized for <div> rather than <li>
 */
class Paginator {
 
     	private $_conn,
     			$_limit,
     			$_page,
     			$_query,
     			$_total;

     	public function initialise( $conn, $query ) {
     
		    $this->_conn  = $conn;
		    $this->_query = $query;
		    $rs 		  = $this->_conn->query( $this->_query );

		    if(!$rs) die($this->_conn->error);

		    $this->_total = $rs->num_rows;
		}


		public function getData( $limit = 8, $page = 1 ) {
     
		    $this->_limit   = $limit;
		    $this->_page    = $page;
		 
		    if ( $this->_limit == 'all' ) {
		        $query      = $this->_query;
		    } else {
		        $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
		    }
		    $rs             = $this->_conn->query( $query );

		    $results = array();

		    while ( $row = $rs->fetch_assoc() ) {
		        $results[]  = $row;
		    }
		 
		    $result         = new stdClass();
		    $result->page   = $this->_page;
		    $result->limit  = $this->_limit;
		    $result->total  = $this->_total;
		    $result->data   = $results;
		 
		    return $result;
		}

		public function createLinks( $links, $list_class ) {

			if ($this->_total == 0) {
				return $html = "<a class='disabled' href='#'>Previous</a><a class='disabled' href='#'>Next</a>";
			}
			
		    if ( $this->_limit == 'all' ) {
		        return '';
		    }
		 
		    $last       = ceil( $this->_total / $this->_limit );
		    $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
		    $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
		    
		    $html       = '';
		    
		    //  previous button link
		    if ($this->_page == 1) {
		    	$class = "disabled";
		    	$href  = "#";
		    } else {
		    	$class = "__d";
		    	$href  = '?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 );
		    }
		    $html       .= '<a class="' . $class . '" href=' . $href . '>Previous</a>';
		    
		    // first link & ... 
		    if ( $start > 1 ) {
		        $html   .= '<a href="?limit=' . $this->_limit . '&page=1">1</a>';
		        $html   .= '<span>...</span>';
		    }
		    
		    // main pagination links
		    for ( $i = $start ; $i <= $end; $i++ ) {
		        $class  = ( $this->_page == $i ) ? "active" : "_d";
		        $html   .= '<a class="' . $class . '" href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a>';
		    }
		    
		    // ... & last link
		    if ( $end < $last ) {
		        $html   .= '<span>...</span>';
		        $html   .= '<a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a>';
		    }

		    //  next button link
		    if ($this->_page == $last) {
		    	$class = "disabled";
		    	$href  = "#";
		    } else {
		    	$class = "__d";
		    	$href  = '?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 );
		    }
		    $html       .= '<a class="' . $class . '" href=' . $href . '>Next</a>';
		
		    return $html;
		}

}