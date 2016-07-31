<?php

use Illuminate\Database\Seeder;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

   	public function run()
    {
    	$cycleLength = 7;
    	$startTime = 0;
		$endTime = 24;
		$startTimeString = "";
		$endTimeString = "";
		
		$currentHour = $startTime;
		$currentMinute = 0;
		$currentDate = new DateTime('today');
		$currentDayOfWeek = $currentDate->format("l");
		
		for($i = 1; $i <= $cycleLength; $i++) {
			do {
				if ($currentMinute == 0) {
					if ($currentHour < 10) {
						$startTimeString = '0'.$currentHour.":".$currentMinute."0:00";
					} else {
						$startTimeString = $currentHour.":".$currentMinute."0:00";
					} 
					
					$currentMinute = 30;
					
					if ($currentHour < 10) {
						$endTimeString = '0'.$currentHour.":".$currentMinute.":00";
					} else {
						$endTimeString = $currentHour.":".$currentMinute.":00";
					} 
				} else {
					if ($currentHour < 10) {
						$startTimeString = '0'.$currentHour.":".$currentMinute.":00";
					} else {
						$startTimeString = $currentHour.":".$currentMinute.":00";	
					}
						
					$currentMinute = 0;
					$currentHour++;
					
					if ($currentHour < 10) {
						$endTimeString = '0'.$currentHour.":".$currentMinute."0:00";
					} else {
						$endTimeString = $currentHour.":".$currentMinute."0:00";
					} 
				}
				
				
				DB::table('times')->insert([
						'day' => $currentDayOfWeek,
						'date' => $currentDate,
						'start_time' => $startTimeString,
						'end_time' => $endTimeString
				]);
				
				
			} while ($currentHour < $endTime);
			$currentHour = $startTime;
			$currentDate->modify('+1 day');
			$currentDayOfWeek = $currentDate->format("l");
		}
  	}
}
