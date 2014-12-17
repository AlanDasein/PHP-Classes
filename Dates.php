<?php
	
	class Dates
	{
		
		public function __construct() {}
		
		public function add_date($_date, $_years, $_months, $_days, $_spacer, $_leading_zeros = 1) {
			
			$values = explode($_spacer, $_date);
			
			for($i = 0;$i < 3;$i++) {$values[$i] = round($values[$i]);}
			
			$values[2] += $_days;
			
			if($values[2] > 31) {
				$aux = floor($values[2] / 31);
				while($values[2] > 31) {$values[2] -= 31;}
				$values[1] += $aux;
			}
			
			$values[1] += $_months;
			$values[0] += $_years;
			
			if($values[1] > 12) {
				$aux = floor($values[1] / 12);
				while($values[1] > 12) {$values[1] -= 12;}
				$values[0] += $aux;
			}
			
			$leapYear = (($values[0] % 4 == 0) && (($values[0] % 100 != 0) || ($values[0] % 400 == 0))) ? 29 : 28;
			$days = Array(0, 31, $leapYear, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
			
			if($values[2] > $days[$values[1]]) {
				$values[2] -= $days[$values[1]];
				$values[1]++;
			}
			
			if($_leading_zeros) {return $this -> leading_zeros($values[0].$_spacer.$values[1].$_spacer.$values[2], $_spacer);}
			else {return $values[0].$_spacer.$values[1].$_spacer.$values[2];}
			
		}
		
		public function subtract_date($_date, $_years, $_months, $_days, $_spacer, $_leading_zeros = 1) {
			
			$values=explode($_spacer, $_date);
			
			for($i = 0;$i < 3;$i++){$values[$i] = round($values[$i]);}
			
			$days = Array(0, 31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
			
			$values[0] -= $_years;
			$values[1] -= $_months;
			
			while($values[1] < 1) {
				$values[1] += 12;
				$values[0]--;
			}
			
			$values[2] -= $_days;
			
			while($values[2] < 1) {		
				$values[1]--;
				if($values[1] == 0) {
					$values[1] = 12;
					$values[0]--;
				}
				if($values[1] == 2) {$days[2] = (($values[0] % 4 == 0) && (($values[0] % 100 != 0) || ($values[0] % 400 == 0))) ? 29 : 28;}
				$values[2] += $days[$values[1]];
			}
			
			if($_leading_zeros) {return $this -> leading_zeros($values[0].$_spacer.$values[1].$_spacer.$values[2], $_spacer);}
			else {return $values[0].$_spacer.$values[1].$_spacer.$values[2];}
		}
		
		public function leading_zeros($_date, $_spacer) {
			
			$_date = $_spacer.$_date.$_spacer;
			
			for($i = 1;$i < 10;$i++) {
				while(strstr($_date, $_spacer.$i.$_spacer)){$_date = str_replace($_spacer.$i.$_spacer, $_spacer.'0'.$i.$_spacer, $_date);}
			}
			
			$_date = substr($_date, 1);
			$_date = substr($_date, 0, -1);
			
			return $_date;
			
		}
		
	}
