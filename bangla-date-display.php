<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: "Bangla Date Display" is a simple and easy to use plugin that allows you to show current bangla, english and hijri date in bangla language anywhere in your blog with some extra features!
Author: M.A. IMRAN
Version: 6.0
Author URI: http://facebook.com/imran2w
*/

#*********************************************************************
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# ( at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Online: http://www.gnu.org/licenses/gpl.txt

# *****************************************************************

class BanglaDate
{
	private $timestamp;	//timestamp as input
	private $morning;	//when the date will change?
	
	private $engHour;	//Current hour of English Date
	private $engDate;	//Current date of English Date
	private $engMonth;	//Current month of English Date
	private $engYear;	//Current year of English Date
	
	private $bangDate;	//generated Bangla Date
	private $bangMonth;	//generated Bangla Month
	private $bangYear;	//generated Bangla	Year

	/*
	 * Set the initial date and time
	 *
	 * @param	int timestamp for any date
	 * @param	int, set the time when you want to change the date. if 0, then date will change instantly.
	 *			If it's 6, date will change at 6'0 clock at the morning. Default is 6'0 clock at the morning
	 */
	function __construct($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}
	
	/*
	* PHP4 Legacy constructor
	*/
	function BanglaDate($timestamp, $hour = 6)
	{
$offset=6*60*60; //converting 6 hours to seconds.
		$this->engDate = gmdate('d', time()+$offset);
		$this->engMonth = gmdate('m', time()+$offset);
		$this->engYear = gmdate('Y', time()+$offset);
		$this->morning = $hour;
		$this->engHour = gmdate('G', time()+$offset);
		
		//calculate the bangla date
		$this->calculate_date();
		
		//now call calculate_year for setting the bangla year
		$this->calculate_year();
		
		//convert english numbers to Bangla
		$this->convert();
	}
	
	function set_time($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}

	/*
	 * Calculate the Bangla date and month
	 */
	function calculate_date()
	{
		//when English month is January
		if($this->engMonth == 1)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "পৌষ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "পৌষ";
				}
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "পৌষ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "পৌষ";
				}
			}

			else if($this->engDate == 14) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "মাঘ";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "পৌষ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "মাঘ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "মাঘ";
				}
			}
		}

		
		//when English month is February		
		else if($this->engMonth == 2)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 18;
					$this->bangMonth = "মাঘ";
				}
				else
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "মাঘ";
				}
			}
			else if($this->engDate < 13 && $this->engDate > 1) // Date 2-12
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 18;
					$this->bangMonth = "মাঘ";
				}
				else
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "মাঘ";
				}
			}

			else if($this->engDate == 13) //Date 13
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 12;
					$this->bangMonth = "ফাল্গুন";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "মাঘ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 12;
					$this->bangMonth = "ফাল্গুন";
				}
				else 
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "ফাল্গুন";
				}
			}
		}
		
		//when English month is March		
		else if($this->engMonth == 3)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					if($this->is_leapyear())$this->bangDate = $this->engDate + 17;
					else $this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ফাল্গুন";
				}
				else
				{
					if($this->is_leapyear()) $this->bangDate = $this->engDate + 16;
					else $this->bangDate = $this->engDate + 15;
					$this->bangMonth = "ফাল্গুন";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					if($this->is_leapyear()) $this->bangDate = $this->engDate + 17;
					else $this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ফাল্গুন";
				}
				else
				{
					if($this->is_leapyear()) $this->bangDate = $this->engDate + 16;
					else $this->bangDate = $this->engDate + 15;
					$this->bangMonth = "ফাল্গুন";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "চৈত্র";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "ফাল্গুন";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "চৈত্র";
				}
				else 
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "চৈত্র";
				}
			}
		}
		
		//when English month is April		
		else if($this->engMonth == 4)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "চৈত্র";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "চৈত্র";
				}
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "চৈত্র";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "চৈত্র";
				}
			}

			else if($this->engDate == 14) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "বৈশাখ";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "চৈত্র";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "বৈশাখ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "বৈশাখ";
				}
			}
		}

		
		//when English month is May
		else if($this->engMonth == 5)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "বৈশাখ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "বৈশাখ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "বৈশাখ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "বৈশাখ";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
					{
						$this->bangDate = $this->engDate - 14;
						$this->bangMonth = "জ্যৈষ্ঠ";
					}
				else
					{
						$this->bangDate = 31;
						$this->bangMonth = "চৈত্র";
					}
			}
			else //Date 16-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
			}
		}

		
		//when English month is June
		else if($this->engMonth == 6)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
				else
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
			}

			else if($this->engDate == 15) //Date 15
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "আষাঢ়";
				}
				else
				{
					$this->bangDate = 31;
					$this->bangMonth = "জ্যৈষ্ঠ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "আষাঢ়";
				}
				else 
				{
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "আষাঢ়";
				}
			}
		}

		
		//when English month is July		
		else if($this->engMonth == 7)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "আষাঢ়";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আষাঢ়";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "আষাঢ়";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আষাঢ়";
				}
			}

			else if($this->engDate == 16) //Date 16
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "শ্রাবণ";
				}
				else
				{
					$this->bangDate = 31;
					$this->bangMonth = "আষাঢ়";
				}
			}
			else //Date 17-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "শ্রাবণ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 16;
					$this->bangMonth = "শ্রাবণ";
				}
			}
		}

		
		//when English month is August
		else if($this->engMonth == 8)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "শ্রাবণ";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "শ্রাবণ";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "শ্রাবণ";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "শ্রাবণ";
				}
			}

			else if($this->engDate == 16) //Date 16
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "ভাদ্র";
				}
				else
				{
					$this->bangDate = 31;
					$this->bangMonth = "শ্রাবণ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "ভাদ্র";
				}
				else 
				{
					$this->bangDate = $this->engDate - 16;
					$this->bangMonth = "ভাদ্র";
				}
			}
		}

		
		//when English month is September
		else if($this->engMonth == 9)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ভাদ্র";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "ভাদ্র";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ভাদ্র";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "ভাদ্র";
				}
			}

			else if($this->engDate == 16) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "আশ্বিন";
				}
				else
				{
					$this->bangDate = 31;
					$this->bangMonth = "ভাদ্র";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "আশ্বিন";
				}
				else 
				{
					$this->bangDate = $this->engDate - 16;
					$this->bangMonth = "আশ্বিন";
				}
			}
		}

		
		//when English month is October
		else if($this->engMonth == 10)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আশ্বিন";
				}
				else
				{
					$this->bangDate = $this->engDate + 14;
					$this->bangMonth = "আশ্বিন";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আশ্বিন";
				}
				else
				{
					$this->bangDate = $this->engDate + 14;
					$this->bangMonth = "আশ্বিন";
				}
			}

			else if($this->engDate == 16) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "কার্তিক";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "আশ্বিন";
				}
			}
			else //Date 17-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "কার্তিক";
				}
				else 
				{
					$this->bangDate = $this->engDate - 16;
					$this->bangMonth = "কার্তিক";
				}
			}
		}

		
		//when English month is November
		else if($this->engMonth == 11)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "কার্তিক";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "কার্তিক";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "কার্তিক";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "কার্তিক";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "অগ্রাহায়ণ";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "কার্তিক";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "অগ্রহায়ণ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "অগ্রহায়ণ";
				}
			}
		}

		
		//when English month is December
		else if($this->engMonth == 12)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "অগ্রহায়ণ";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "অগ্রহায়ণ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "অগ্রহায়ণ";
				}
				else
				{
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "অগ্রহায়ণ";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "পৌষ";
				}
				else
				{
					$this->bangDate = 30;
					$this->bangMonth = "অগ্রহায়ণ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "পৌষ";
				}
				else 
				{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "পৌষ";
				}
			}
		}
	}

	/*
	 * Checks, if the date is leapyear or not
	 *
	 * @return boolen. True if it's leap year or returns false
	 */
	function is_leapyear()
	{
		if($this->engYear%400 ==0 || ($this->engYear%100 != 0 && $this->engYear%4 == 0))
			return true;
		else
			return false;
	}

	/*
	 * Calculate the Bangla Year
	 */
	function calculate_year()
	{
		if($this->engMonth >= 4)
		{
			if($this->engMonth == 4 && $this->engDate < 14) //1-13 on april when hour is greater than 6
				{
					$this->bangYear = $this->engYear - 594;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour <=5)
				{
					$this->bangYear = $this->engYear - 594;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour >=6)
				{
					$this->bangYear = $this->engYear - 593;
				}	
			/*else if($this->engMonth == 4 && ($this->engDate == 14 && $this->engDate) && $this->engHour <=5) //1-13 on april when hour is greater than 6
				{
					$this->bangYear = $this->engYear - 593;
				}
				*/
			else
				$this->bangYear = $this->engYear - 593;
		}
		else $this->bangYear = $this->engYear - 594;
	}

	/*
	 * Convert the English character to Bangla
	 *
	 * @param int any integer number
	 * @return string as converted number to bangla
	 */
	function bangla_number($int)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
		
		$converted = str_replace($engNumber, $bangNumber, $int);
		return $converted;
	}

	/*
	 * Calls the converter to convert numbers to equivalent Bangla number
	 */
	function convert()
	{
		$this->bangDate = $this->bangla_number($this->bangDate);
		$this->bangYear = $this->bangla_number($this->bangYear);
	}

	/*
	 * Returns the calculated Bangla Date
	 *
	 * @return array of converted Bangla Date
	 */
	function get_day()	{		return array($this->bangDate);	}
function get_month_year()	{		return array($this->bangMonth, $this->bangYear);	}
	function get_month()
	{
		return array($this->bangMonth);
	}
}


function bangla_time() {

$offset=6*60*60; //converting 6 hours to seconds.
$hour = gmdate("G", time()+$offset);

if ($hour >= 5 && $hour <= 5) { echo "ভোর "; }
else if ($hour >= 6 && $hour <= 11) { echo "সকাল "; }
else if ($hour >= 12 && $hour <= 14) { echo "দুপুর "; }
else if ($hour >= 15 && $hour <= 17) { echo "বিকাল "; }
else if ($hour >= 18 && $hour <= 19) { echo "সন্ধ্যা "; }
else { echo "রাত "; }

$bangla_time = bn_number(gmdate("g:i", time()+$offset));

return $bangla_time;
}


function bn_day() {

$day = array( "Sat" => "শনিবার",
"Sun" => "রবিবার",
"Mon" => "সোমবার", 
"Tue" => "মঙ্গলবার", 
"Wed" => "বুধবার", 
"Thu" => "বৃহস্পতিবার", 
"Fri" => "শুক্রবার", 
);

$offset=6*60*60; //converting 6 hours to seconds.
$bangla_day = $day[gmdate("D", time()+$offset)];

return $bangla_day;
}

function bangla_date_function() {

$bn = new BanglaDate(time(), 0);
$bdtday = $bn->get_day();
$bdtmy = $bn->get_month_year();

$day_n = sprintf( '%s', implode( ' ', $bdtday ) );
$month_year = sprintf( '%s', implode( ' ', $bdtmy ) );

$day = $day_n;

if($day == "১") {$day = "১লা"; }
elseif($day == "২") {$day = "২রা";}
elseif($day == "৩") {$day = "৩রা";}
elseif($day == "৪") {$day = "৪ঠা";}
elseif($day == "৫") {$day = "৫ই";}
elseif($day == "৬") {$day = "৬ই";}
elseif($day == "৭") {$day = "৭ই";}
elseif($day == "৮") {$day = "৮ই";}
elseif($day == "৯") {$day = "৯ই";}
elseif($day == "১০") {$day = "১০ই";}
elseif($day == "১১") {$day = "১১ই";}
elseif($day == "১২") {$day = "১২ই";}
elseif($day == "১৩") {$day = "১৩ই";}
elseif($day == "১৪") {$day = "১৪ই";}
elseif($day == "১৫") {$day = "১৫ই";}
elseif($day == "১৬") {$day = "১৬ই";}
elseif($day == "১৭") {$day = "১৭ই";}
elseif($day == "১৮") {$day = "১৮ই";}
elseif($day == "১৯") {$day = "১৯শে";}
elseif($day == "২০") {$day = "২০শে";}
elseif($day == "২১") {$day = "২১শে";}
elseif($day == "২২") {$day = "২২শে";}
elseif($day == "২৩") {$day = "২৩শে";}
elseif($day == "২৪") {$day = "২৪শে";}
elseif($day == "২৫") {$day = "২৫শে";}
elseif($day == "২৬") {$day = "২৬শে";}
elseif($day == "২৭") {$day = "২৭শে";}
elseif($day == "২৮") {$day = "২৮শে";}
elseif($day == "২৯") {$day = "২৯শে";}
elseif($day == "৩০") {$day = "৩০শে";}
elseif($day == "৩১") {$day = "৩১শে";}

echo $day; echo ' '; echo $month_year; echo ' বঙ্গাব্দ';

}

function bn_season() {

$bn = new BanglaDate(time(), 0);
$bdtmonth = $bn->get_month();
$month = sprintf( '%s', implode( ' ', $bdtmonth ) );

$season = $month;

if($season == "বৈশাখ") {$season = "গ্রীষ্মকাল"; }
elseif($season == "জৈষ্ঠ") {$season = "গ্রীষ্মকাল";}
elseif($season == "আষাঢ়") {$season = "বর্ষাকাল";}
elseif($season == "শ্রাবণ") {$season = "বর্ষাকাল";}
elseif($season == "ভাদ্র") {$season = "শরৎকাল";}
elseif($season == "আশ্বিন") {$season = "শরৎকাল";}
elseif($season == "কার্তিক") {$season = "হেমন্তকাল";}
elseif($season == "অগ্রহায়ণ") {$season = "হেমন্তকাল";}
elseif($season == "পৌষ") {$season = "শীতকাল";}
elseif($season == "মাঘ") {$season = "শীতকাল";}
elseif($season == "ফাল্গুন") {$season = "বসন্তকাল";}
elseif($season == "চৈত্র") {$season = "বসন্তকাল";}

echo $season;

}


function bn_number($number) {

/*

like this:

$number= str_replace("English Number", "Bengali Number", $number);

translate 0-9

*/

$number= str_replace("0", "০", $number);

$number= str_replace("1", "১", $number);

$number= str_replace("2", "২", $number);

$number= str_replace("3", "৩", $number);

$number= str_replace("4", "৪", $number);

$number= str_replace("5", "৫", $number);

$number= str_replace("6", "৬", $number);

$number= str_replace("7", "৭", $number);

$number= str_replace("8", "৮", $number);

$number= str_replace("9", "৯", $number);

return $number;

return $number;

}


function bn_en_date() {

$month = array( "1" => "জানুয়ারি",
"2" => "ফেব্রুয়ারি",
"3" => "মার্চ", 
"4" => "এপ্রিল", 
"5" => "মে", 
"6" => "জুন", 
"7" => "জুলাই", 
"8" => "আগস্ট", 
"9" => "সেপ্টেম্বর", 
"10" => "অক্টবর",  
"11" => "নভেম্বর", 
"12" => "ডিসেম্বর" 
);

$day_number = array( "1" => "১লা",
"2" => "২রা",
"3" => "৩রা",
"4" => "৪ঠা",
"5" => "৫ই",
"6" => "৬ই",
"7" => "৭ই",
"8" => "৮ই",
"9" => "৯ই",
"10" => "১০ই",
"11" => "১১ই",
"12" => "১২ই",
"13" => "১৩ই",
"14" => "১৪ই",
"15" => "১৫ই",
"16" => "১৬ই",
"17" => "১৭ই",
"18" => "১৮ই",
"19" => "১৯শে",
"20" => "২০শে",
"21" => "২১শে",
"22" => "২২শে",
"23" => "২৩শে",
"24" => "২৪শে",
"25" => "২৫শে",
"26" => "২৬শে",
"27" => "২৭শে",
"28" => "২৮শে",
"29" => "২৯শে",
"30" => "৩০শে",
"31" => "৩১শে"
);

$offset=6*60*60; //converting 6 hours to seconds.
$bangla_date = $day_number[gmdate("j", time()+$offset)] . " " . $month[gmdate("n", time()+$offset)] . ", " . bn_number(gmdate("Y", time()+$offset)) . " ইং";

return $bangla_date;

}

function bn_hijri_date() {

include "uCal.class.php";
$d = new uCal;

$Hday = $d->date("j");

if($Hday == "1") {$Hday = "১লা"; }
elseif($Hday == "2") {$Hday = "২রা";}
elseif($Hday == "3") {$Hday = "৩রা";}
elseif($Hday == "4") {$Hday = "৪ঠা";}
elseif($Hday == "5") {$Hday = "৫ই";}
elseif($Hday == "6") {$Hday = "৬ই";}
elseif($Hday == "7") {$Hday = "৭ই";}
elseif($Hday == "8") {$Hday = "৮ই";}
elseif($Hday == "9") {$Hday = "৯ই";}
elseif($Hday == "10") {$Hday = "১০ই";}
elseif($Hday == "11") {$Hday = "১১ই";}
elseif($Hday == "12") {$Hday = "১২ই";}
elseif($Hday == "13") {$Hday = "১৩ই";}
elseif($Hday == "14") {$Hday = "১৪ই";}
elseif($Hday == "15") {$Hday = "১৫ই";}
elseif($Hday == "16") {$Hday = "১৬ই";}
elseif($Hday == "17") {$Hday = "১৭ই";}
elseif($Hday == "18") {$Hday = "১৮ই";}
elseif($Hday == "19") {$Hday = "১৯শে";}
elseif($Hday == "20") {$Hday = "২০শে";}
elseif($Hday == "21") {$Hday = "২১শে";}
elseif($Hday == "22") {$Hday = "২২শে";}
elseif($Hday == "23") {$Hday = "২৩শে";}
elseif($Hday == "24") {$Hday = "২৪শে";}
elseif($Hday == "25") {$Hday = "২৫শে";}
elseif($Hday == "26") {$Hday = "২৬শে";}
elseif($Hday == "27") {$Hday = "২৭শে";}
elseif($Hday == "28") {$Hday = "২৮শে";}
elseif($Hday == "29") {$Hday = "২৯শে";}
elseif($Hday == "30") {$Hday = "৩০শে";}
elseif($Hday == "31") {$Hday = "৩১শে";}

$Hmonth = $d->date("M");

if($Hmonth == "Muh") {$Hmonth = "মহররম";}
elseif($Hmonth == "Saf") {$Hmonth = "সফর"; }
elseif($Hmonth == "Rb1") {$Hmonth = "রবিউল-আউয়াল";}
elseif($Hmonth == "Rb2") {$Hmonth = "রবিউস-সানি";}
elseif($Hmonth == "Jm1") {$Hmonth = "জমাদিউল-আউয়াল";}
elseif($Hmonth == "Jm2") {$Hmonth = "জমাদিউস-সানি";}
elseif($Hmonth == "Raj") {$Hmonth = "রজব";}
elseif($Hmonth == "Shb") {$Hmonth = "সাবান";}
elseif($Hmonth == "Rmd") {$Hmonth = "রমজান";}
elseif($Hmonth == "Shw") {$Hmonth = "শাওয়াল";}
elseif($Hmonth == "DhQ") {$Hmonth = "জিলক্বদ";}
elseif($Hmonth == "DhH") {$Hmonth = "জিলহজ্জ";}

$hijridate = $Hday . " " . $Hmonth . ", " . bn_number($d->date("Y")) . " হিজরী";
return $hijridate;
}


function bddp_header_content() {
?>

<script type="text/javascript">
var mn = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
function buildCal(m, y, cM, cH, cDW, cD, brdr){
var bnum=['&#2535;']
var dim=[31,0,31,30,31,30,31,31,30,31,30,31];

var oD = new Date(y, m-1, 1); //DD replaced line to fix date bug when current day is 31st
oD.setTime(oD.getTime() + (oD.getTimezoneOffset() + 360) * 60 * 1000); 
    var bcal = Bangla_Date(y, m, 25);
    var bcal1 = Bangla_Date(y, m, 10);
oD.od=oD.getDay()+1; //DD replaced line to fix date bug when current day is 31st
var byy = (m == 4) ? convert((bcal[0]-1)) + '  ' + convert(bcal[0]) : convert(bcal[0]);
var todaydate = new Date() //DD added
todaydate.setTime(todaydate.getTime() + (todaydate.getTimezoneOffset() + 360) * 60 * 1000); 
var scanfortoday=(y==todaydate.getFullYear() && m==todaydate.getMonth()+1)? todaydate.getDate() : 0 //DD added

dim[1]=(((oD.getFullYear()%100!=0)&&(oD.getFullYear()%4==0))||(oD.getFullYear()%400==0))?29:28;
var t='<div class="'+cM+'"><table class="'+cM+'" cols="7" cellpadding="0" border="'+brdr+'" cellspacing="0"><tr align="center"><td colspan="2">'+beng_month_name[bcal1[1]]+'</td><td colspan="3">'+ byy + '</td><td colspan="2">' + beng_month_name[bcal[1]] + '</td><tr align="center">';
t+='<td colspan="7" align="center" class="'+cH+'">'+mn[m-1]+' - '+y+'</td></tr><tr align="center">';
t+='<tr align="center"><td>রবি</td>	<td>সোম</td><td>মঙ্গল</td><td>বুধ</td><td>বৃহঃ</td><td>শুক্র</td><td>শনি</td></tr><tr align="center">';
for(s=0;s<7;s++)t+='<td class="'+cDW+'">'+"SMTWTFS".substr(s,1)+'</td>';
t+='</tr><tr align="center">';
for(i=1;i<=42;i++){
var x=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? i-oD.od+1 : ' ';
    var indcal = Bangla_Date(y, m, i-oD.od+1);
	var indcal1 = indcal[2]==1? '<font size="3" color="#800000">' + convert(indcal[2]) + '</font>' :  convert(indcal[2])
	var xj=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? indcal1 : ' ';
if (x==scanfortoday) //DD added
x='<span id="today">'+x+'</span>' //DD added
t+='<td class="'+cD+'">'+x+'<br><span id="bangla">' + xj + '</span></td>';
if(((i)%7==0)&&(i<36))t+='</tr><tr align="center">';
}
return t+='</tr></table></div>';
}
var beng_month_name = new Array;
beng_month_name[1] 		= "বৈশাখ";
beng_month_name[2] 		= "জ্যৈষ্ঠ";
beng_month_name[3] 		= "আষাঢ়";
beng_month_name[4] 		= "শ্রাবণ";
beng_month_name[5] 		= "ভাদ্র";
beng_month_name[6] 		= "আশ্বিন";
beng_month_name[7] 		= "কার্তিক";
beng_month_name[8] 		= "অগ্রহায়ন";
beng_month_name[9] 		= "পৌষ";
beng_month_name[10] 		= "মাঘ";
beng_month_name[11] 		= "ফাল্গুন";
beng_month_name[12] = "চৈত্র";

var bmonth_len = "";


var Weekdays = new Array( "Sunday", "Monday", "Tuesday", "Wednesday",
                          "Thursday", "Friday", "Saturday");
var bWeekdays = new Array("রবি", "সোম", "মঙ্গল", "বুধ", "বৃহস্পতি", "শুক্র", "শনি", "রবি");
var bWeekdays1 = new Array("রবি", "সোম", "মঙ্গল", "বুধ", "বৃহ:", "শুক্র", "শনি", "রবি");


function convert(str) {
	var mystr =str.toString();
var outj;	// javascript escaped hex
var outj1;
var be = new Array();
be['1'] = "\u09E7";
be['2'] = "\u09E8";
be['3'] = "\u09E9";
be['4'] = "\u09EA";
be['5'] = "\u09EB";
be['6'] = "\u09EC";
be['7'] = "\u09ED";
be['8'] = "\u09EE";
be['9'] = "\u09EF";
be['0'] = "\u09E6";
be[' '] = '';
be['-'] = '-';
outj1="";
for(var i=0; i<mystr.length; i++)
{	
var ch = mystr.substr(i,1);
	outj  = be[ch];
	outj1+=outj;
}
return outj1;

}

var mas_len = [0, 30.92569444, 62.63289352, 94.00184028, 125.4761458, 156.4885417, 186.9247338, 216.8066667, 246.3155787, 275.6427546, 305.0935301, 334.9103588, 365.2587564814815];

function ModernDate_to_Julianeday(eyear, emonth, eday) {
    var julian_eday;

    if (emonth < 3) {
        eyear = eyear - 1;
        emonth = emonth + 12;
    }

    julian_eday = Math.floor((365.25 * eyear)) + Math.floor(30.59 * (emonth - 2)) + eday + 1721086.5;
    if (eyear < 0) {
        julian_eday = julian_eday - 1;
        if (((eyear % 4) == 0) && (3 <= emonth)) {
            julian_eday = julian_eday + 1;
        }
    }
    if (2299160 < julian_eday) {
        julian_eday = julian_eday + Math.floor(eyear * 1.0 / 400) - Math.floor(eyear * 1.0 / 100) + 2;
    }

    return julian_eday;
}

function Bangla_Date(eyear, emonth, eday) {
var country = "India";

    var str = "";
    var startjd = 0.0;
    if (country = "India") {
        startjd = 1938094.4629; //India
    }
    else {
        startjd = 1938094.483733333;
    }
    var nJD = ModernDate_to_Julianeday(eyear, emonth, eday);
    if (nJD < startjd) {
        str = " Date is not appropriate.\n";
    }
    else {
        var jddiff = nJD - startjd;
        var lasteyear = Math.floor(jddiff / 365.2587564814815);
        var mesh = startjd + lasteyear * 365.2587564814815;
        var lasteday = 0.0;
        var ps, ns, bemonth, beday;
        for (var i = 0; i < 12; i++) {
            ps = mesh + mas_len[i];
            ns = mesh + mas_len[i + 1];
            if ((nJD >= ps) && (nJD <= Math.floor(ns) + 1.75)) {
                bemonth = i + 1;
                beday = Math.floor(nJD - ps) + 1;
                //bmonth_len =Math.floor(ns) + 0.5;
            }

        }
        var array = [];
          for (var i = 0; i < 12; i++)
                     {
                         lastday = mesh + mas_len[i];
                         var nda = new Date(calData(lastday + 1).toDateString());
                         array.push((nda.getMonth()+1) + "/" + nda.getDate() + "/" + nda.getFullYear());
                     }
                     bmonth_len = array.join(",");

        //var bar = Math.floor(nJD + 0.5) % 7 + 1;
        //str = convert(beday) + " " + beng_month_name[bemonth] + " " + convert(lasteyear + 1) + " বঙ্গাব্দ, " + Weekedays[bar] + "বার।";

    }
    //return str;
     return new Array(lasteyear + 1, bemonth, beday);

}
function oneDay() {
    var now = new Date();
    now.setTime(now.getTime() + (now.getTimezoneOffset() + 360) * 60 * 1000); 
    var eday= now.getDate();
    var emonth = now.getMonth();
    var eyear = now.getFullYear();
    var bcal = Bangla_Date(eyear, emonth + 1, eday);
    var nJD = ModernDate_to_Julianeday(eyear, emonth + 1, eday);
    var bar = Math.floor(nJD + 0.5) % 7 + 1;
    var str = convert(bcal[2]) + " " + beng_month_name[bcal[1]] + " " + convert((bcal[0])) + " বঙ্গাব্দ, " + bWeekdays[bar] + "বার।";
    return str;
}
function formSubmit()
{
    var todaydate = new Date();
    todaydate.setTime(todaydate.getTime() + (todaydate.getTimezoneOffset() + 360) * 60 * 1000); 
var curyear=todaydate.getFullYear();
var myyear;
if ((document.bdcalendar.myear.value)<595) 
{ myyear =curyear;}
else 
{myyear=document.bdcalendar.myear.value;}
var bdcal="";
bdcal+='<table border="0" width="80%" id="table1" cellspacing="0" cellpadding="0">' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(1, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(2, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(3, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(4, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(5, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(6, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(7, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(8, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(9, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(10, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(11, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(12, myyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
bdcal+='</table>' ;
document.all.vvv.innerHTML=bdcal;
}
//------------------------------------------------------------------------------------------
// Calendar day from Julian Day
//------------------------------------------------------------------------------------------
function calData(jd)
{
with(Math){
z1 = jd + 0.5;
z2 = floor(z1);
f = z1 - z2;
if(z2 < 2299161)a = z2;
else {
alf = floor((z2 - 1867216.25)/36524.25);
a = z2 + 1 + alf - floor(alf/4);
}
b = a + 1524;
c = floor((b - 122.1)/365.25);
d = floor(365.25*c);
e = floor((b - d)/30.6001);
days = b - d - floor(30.6001*e) + f;
kday = floor(days);
if(e < 13.5)kmon = e - 1;
else kmon = e - 13;
if(kmon > 2.5)kyear = c - 4716;
if(kmon < 2.5)kyear = c - 4715;
hh1 = (days - kday)*24;
khr = floor(hh1);
kmin = hh1 - khr;
ksek = kmin*60;
kmin = floor(ksek);
ksek = floor((ksek - kmin)*60);
if (kday < 10)kday = " " + kday;
if (khr < 10)khr = "0" + khr;
if (kmin < 10)kmin = "0" + kmin;
if (ksek < 10)ksek = "0" + ksek;
var dstr = mn[kmon - 1] + " " + kday + ", " + kyear + " " + khr + ":" + kmin + ":00";
//var sDate = new Date(Date.parse("03/20/2012", "MM/dd/yyyy"));
s = new Date(dstr);

}
return s;
}

function BanglaMas() {
    var dynTable = "";
    var now = new Date();
    now.setTime(now.getTime() + (now.getTimezoneOffset() + 360) * 60 * 1000); 
    var day = now.getDate();
    var month = now.getMonth();
    var year = now.getFullYear();
    var bcal = Bangla_Date(year, month + 1, day);
    var mesh = 1938094.4629 + (bcal[0] - 1) * 365.2587564814815;
    var bar = calData(mesh + mas_len[bcal[1] - 1] + 1);
    var startingDay = bar.getDay();
    var one_day = 1000 * 60 * 60 * 24;
    var mr = bmonth_len.split(",");
    var diff = Math.ceil((new Date(mr[bcal[1]]) - new Date(mr[bcal[1] - 1])) / (one_day));

    var monthLength = diff;
    //bcal[2]
   var html = '<table class="gridtable">';
   html += '<tr><th colspan="7">';
   html += beng_month_name[bcal[1]] + "&nbsp;" + convert((bcal[0])) + " বঙ্গাব্দ";
   html += '</th></tr>';
   html += '<tr>';
   for (var i = 0; i <= 6; i++) {
       html += '<td style=\"color: red; background: #99ff66; border: 1px solid black; font: 12px Siyam Rupali;\">';
       html += bWeekdays1[i];
       html += '</td>';
   }
   html += '</tr><tr>';
   var day = 1;
  // this loop is for is weeks (rows)
  for (var i = 0; i < 9; i++) {
    // this loop is for weekdays (cells)
    for (var j = 0; j <= 6; j++) { 
      html += '<td>';
      if (day <= monthLength && (i > 0 || j >= startingDay)) {
          if (day == bcal[2]) //DD added
          {
              html += 'আজ<br><font size="3" color="red">' + convert(day) + '</font><br>'; //DD added
          }
          else {
              html += convert(day) + '<br>';
          }
      day++;
  }
  html += '</td>';
}
// stop making rows if we've run out of days
if (day > monthLength) {
    break;
} else {
    html += '</tr><tr>';
}
}
html += '</tr></table>';
return html;
}
</script>

<style type="text/css">

.bc_main {
width:200px;
border:1px solid black;
}

.bc_month {
background-color:black;
font:bold 12px verdana;
color:white;
}

.bc_daysofweek {
background-color:gray;
font:bold 12px verdana;
color:white;
}

.bc_days {
font-size: 24px;
font-family:verdana;
color:black;
background-color: lightyellow;
padding: 2px;
}

.bc_days #bangla{
font-size: 10px;
text-align:left;
font-family:verdana;
color: green;
}

.bc_days #today{
font-weight: bold;
color: red;
}

</style>

<?php
}


function bn_calendar() {
?>

<script type="text/javascript">
document.write(BanglaMas());
</script>

<?php
}


function en_bn_calendar() {
?>

<script type="text/javascript">

var todaydate=new Date();
todaydate.setTime(todaydate.getTime() +(todaydate.getTimezoneOffset()+360)*60*1000); 
var curmonth=todaydate.getMonth()+1; //get current month (1-12)
var curyear=todaydate.getFullYear(); //get current year

document.write(buildCal(curmonth ,curyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1));
</script>

<?php
}



function widget_bangla_date_display($args) {
extract($args);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'আজকের দিন-তারিখ' . $after_title; ?>
<ul>
<li><?php echo do_shortcode('[bangla_day]'); ?> ( <?php echo do_shortcode('[bangla_time]'); ?> )</li>
<li><?php echo do_shortcode('[english_date]'); ?></li>
<li><?php echo do_shortcode('[hijri_date]'); ?></li>
<li><?php echo do_shortcode('[bangla_date]'); ?> ( <?php echo do_shortcode('[bangla_season]'); ?> )</li>
</ul>
<?php echo $after_widget; ?>
<?php
}

function widget_bn_calendar($args) {
extract($args);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'বাংলা ক্যালেন্ডার' . $after_title; ?>
<ul>
<?php echo do_shortcode('[bn_calendar]'); ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

function widget_en_bn_calendar($args) {
extract($args);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'বাংলা ক্যালেন্ডার' . $after_title; ?>
<ul>
<?php echo do_shortcode('[en_bn_calendar]'); ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

if(is_admin())
	include 'bddp_admin.php';

add_action('wp_head', 'bddp_header_content');
register_sidebar_widget('Bangla Date Display', 'widget_bangla_date_display');
register_sidebar_widget('Monthly Calendar (Bangla)', 'widget_bn_calendar');
register_sidebar_widget('Monthly Calendar (Bangla + Gregorian)', 'widget_en_bn_calendar');
add_shortcode('bangla_time', 'bangla_time');
add_shortcode('bangla_day', 'bn_day');
add_shortcode('bangla_date', 'bangla_date_function');
add_shortcode('bangla_season', 'bn_season');
add_shortcode('english_date', 'bn_en_date');
add_shortcode('hijri_date', 'bn_hijri_date');
add_shortcode('bn_calendar', 'bn_calendar');
add_shortcode('en_bn_calendar', 'en_bn_calendar');

?>