<?php

class foodsview extends foods {

	public $num_row;
	public $total_data;
	public $total_page;
	public $start;
	public $special_count;

	public function getSpecial($cus_id) {
		$stmt = $this->SELECT_SPECIAL($cus_id);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->spcial_count = $stmt->rowCount();
		return $results;
	}

	public function getId($id) {
		$stmt = $this->SELECT($id);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	public function recent($cus_id, $status) {
		$stmt = $this->SELECT_RECENT($cus_id, $status);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function myOrder($cus_id, $mf_id) {
		$stmt = $this->SELECT_ORDER_MFID($cus_id, $mf_id);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->num_row = $stmt->rowCount();
		return $results;
	}

	public function getDetail($id) {
		$stmt = $this->SELECT_DETAIL($id);
		// $stmt = $this->SELECT_TBN($tb, $id);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function menu($type) {
		$stmt = $this->SELECT_MENU($type);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function allmenu() {
		$stmt = $this->SELECT_ALLMENU();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getOrder($res_id) {

		$stmt = $this->SELECT_ORDER($res_id);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;

	}

	public function getOrder_Type($res_id, $type) {
		
		$stmt = $this->SELECT_ORDER_TYPE($res_id, $type);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function search($search) {
		$stmt = $this->SELECT_NAME($search);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function pagination_menu($type, $row, $currentPage) {
		if (empty($type)) {
			$foods = self::allmenu();
		} else {
			$foods = self::menu($type);
		}

		$this->total_data = count($foods);
		$this->total_page = ceil($this->total_data / $row);
		if ($currentPage > $this->total_page) {
			$this->start = 0;
		} else {
			$this->start = ($currentPage - 1) * $row;
		}

		if (empty($type)) {
			$stmt = $this->SELECT_ALLMENULIMIT($this->start, $row);
		} else {
			$stmt = $this->SELECT_MENULIMIT($type, $this->start, $row);
		}

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function pagination($search, $row, $currentPage) {
		$foods = self::search($search);
		$this->total_data = count($foods);
		$this->total_page = ceil($this->total_data / $row);
		$this->start = ($currentPage - 1) * $row;
		$stmt = $this->SELECT_LIMIT($search, $this->start, $row);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function navPagination(int $currentPage) {
		if ($currentPage < 1) {
			$currentPage = 1;
		}

		if ($currentPage > $this->total_page) {
			$currentPage = $this->total_page;
		}

		$pre = $currentPage - 1;
		$nex = $currentPage + 1;

		$last = $this->total_page - 3;
		$nexx = $currentPage + 3;
		if ($nexx > $this->total_page) {
			$nexx = $this->total_page;
		}

		if ($pre < 0) {
			$pre = 0;
		}

		echo "<nav aria-label='Page navigation example'>";
		echo "<ul class='pagination justify-content-center'>";

		if ($currentPage != 1) {
			if ($currentPage == 0) {
				echo "<li class='page-item disabled'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";
			} else {
				echo "<li class='page-item'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";
			}
		} else {
			echo "<li class='page-item disabled'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";

		}

		if ($currentPage <= 4) {
			for ($prev = 3; $prev > 0; $prev--) {
				$pre = $currentPage - $prev;
				if ($pre > 0) {
					echo "<li class='page-item'><a class='page-link' href='?p=$pre'> $pre </a></li>";
				}
			}
		} else {
			echo "<li class='page-item'><a class='page-link' href='?p=1'> 1 </a></li>";
			echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			for ($prev = 3; $prev > 0; $prev--) { 
				$pre = $currentPage - $prev;
				echo " <a class='page-link' href='?p=$pre'> $pre </a></li>";
			}
		}

		echo "<li class='page-item active'><a class='page-link' href='?p=$currentPage'> $currentPage </a></li>";

		

		if ($currentPage >= $last) {
			for ($next = $currentPage + 1; $next <= $nexx ; $next++) { 
				if ($next > $this->total_page) {
					$next = $this->total_page;
				}
				echo "<li class='page-item'><a class='page-link' href='?p=$next'> $next </a></li>";
			}
		}else{
			for ($next = $currentPage + 1; $next <= $nexx ; $next++) { 
				if ($next > $this->total_page) {
					$next = $this->total_page;
				}
				echo "<li class='page-item'><a class='page-link' href='?p=$next'> $next </a></li>";
			}
			if ($this->total_page >7) {
				
			}
			echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			echo "<li class='page-item'><a class='page-link' href='?p=$this->total_page'> $this->total_page </a></li>";
		}
		if ($nex > $this->total_page) {
			$nex = $this->total_page;
		}
		if ($currentPage != $this->total_page) {
			echo "<li class='page-item'><a class='page-link' href='?p=$nex'> <i class='fad fa-angle-double-right animated fadeOutRight delay-1s infinite slow'></i> </a></li>";
		}else{
			echo "<li class='page-item disabled'><a class='page-link' href='?p=$nex'> <i class='fad fa-angle-double-right animated fadeOutRight delay-1s infinite slow'></i> </a></li>";
		}

		echo '</ul>';
		echo '</nav>';
	}

}

?>