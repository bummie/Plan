// Gir ut array av oppkuttede planbilder
// :)
	
	//Defaults
	var BASE_ADRESS = "http://beasla.bevster.net/beasla/net/bea_crop.php";

	function returnPlanImage(index, skoleid, stuid, uke, bredde, lengde, type, dimen )
	{

	var IMG = null;

	//Values
	var V_SCHOOLID = skoleid;
	var V_STUDENTID = stuid;
	var V_WEEK = uke;
	var V_WIDTH = bredde;
	var V_HEIGHT = lengde;

	var V_INDEX = index;

	
	var V_CUT_X = 0;
	var V_CUT_Y = 0;
	var V_CUT_W = V_WIDTH;
	var V_CUT_H = V_HEIGHT;


	switch (type)
	{
		case '0':
				
	 			V_CUT_W = V_WIDTH/5;
	 			V_CUT_H = V_HEIGHT;

			if(dimen == '0')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/

						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}//;
			}else if(dimen == '1')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/
						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}//;
			}else if(dimen == '2')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/
						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}//;

			}else{
					if(V_INDEX != 0)V_CUT_X += (V_INDEX*V_CUT_W);
					IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
			}

		break;
		
		case '1':
		
					var V_CUT_X = 0;
					var V_CUT_Y = 0;
					var V_CUT_W = V_WIDTH;
					var V_CUT_H = V_HEIGHT;
					IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				
		break;
		
		case '2':
				if(V_INDEX >= 5) //Siste bildet i full storelse
				{
					
					V_CUT_X = 0;
	 				V_CUT_Y = 0;
	 				V_CUT_W = V_WIDTH;
	 				V_CUT_H = V_HEIGHT;
	
				}else{	//Kutter opp bildet i fem biter
						
	 					V_CUT_W = V_WIDTH/5;
	 					V_CUT_H = V_HEIGHT;
	 			}		
		
			if(dimen == '0')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/

						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}////;
			}else if(dimen == '1')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/
						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}//;
			}else if(dimen == '2')
			{
				
					/*if(V_INDEX != 0)
					{
						if(V_INDEX == 3)
						{
							V_CUT_X += V_CUT_W - V_INDEX + 2;
						}else if(V_INDEX == 4){
							V_CUT_X += V_CUT_W - V_INDEX + 3;
						}else{
							V_CUT_X += V_CUT_W - V_INDEX;
						}*/
						V_CUT_X += (V_INDEX*V_CUT_W);
						IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
					//}//;

			}else{
					if(V_INDEX != 0)V_CUT_X += (V_INDEX*V_CUT_W);
					IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
			}	
			
				//IMG = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
			//}//;

		break;
	}
		return IMG;
	}

	function returnPlanArray(skoleid, stuid, uke, bredde, lengde, type, dimen )
	{

	var imgArray = new Array();

	//Values
	var V_SCHOOLID = skoleid;
	var V_STUDENTID = stuid;
	var V_WEEK = uke;
	var V_WIDTH = bredde;
	var V_HEIGHT = lengde;
	
	var V_CUT_X = 0;
	var V_CUT_Y = 0;
	var V_CUT_W = V_WIDTH;
	var V_CUT_H = V_HEIGHT;


	switch (type)
	{
		case '0':
				
	 			V_CUT_W = V_WIDTH/5;
	 			V_CUT_H = V_HEIGHT;

			if(dimen == '0')
			{
				for (var i = 0; i < 5; i++) 
				{
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
				}	
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;
			}else if(dimen == '1')
			{
				for (var i = 0; i < 5; i++) 
				{
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
				}	
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;
			}else if(dimen == '2')
			{
				for (var i = 0; i < 5; i++) 
				{
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
				}	
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;

			}else{
				
				for (var i = 0; i < 5; i++) 
				{
					if(i != 0)V_CUT_X += V_CUT_W;
					imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}

			}

		break;
		
		case '1':
		for (var i = 0; i < 1; i++) 
				{
					var V_CUT_X = 0;
					var V_CUT_Y = 0;
					var V_CUT_W = V_WIDTH;
					var V_CUT_H = V_HEIGHT;
						imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}
		break;
		
		case '2':
			for (var i = 0; i < 6; i++)
			{
			
				if(i >= 5) //Siste bildet i full storelse
				{
					
					V_CUT_X = 0;
	 				V_CUT_Y = 0;
	 				V_CUT_W = V_WIDTH;
	 				V_CUT_H = V_HEIGHT;
	
				}else{	//Kutter opp bildet i fem biter
						
	 					V_CUT_W = V_WIDTH/5;
	 					V_CUT_H = V_HEIGHT;
		
			if(dimen == '0')
			{
				
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
					
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;
			}else if(dimen == '1')
			{
				
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
					
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;
			}else if(dimen == '2')
			{
				
					if(i != 0)
					{
						if(i == 3)
						{
							V_CUT_X += V_CUT_W - i + 2;
						}else if(i == 4){
							V_CUT_X += V_CUT_W - i + 3;
						}else{
							V_CUT_X += V_CUT_W - i;
		
					}
					
				
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
				}//;
		
					}else{
						
							if(i != 0)V_CUT_X += V_CUT_W;
							imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
						
		
					}
		
				}	
			
				imgArray[i] = BASE_ADRESS + "?skoleid="+V_SCHOOLID+"&stuid="+V_STUDENTID+"&uke="+V_WEEK+"&planbredde="+V_WIDTH+"&planlengde="+V_HEIGHT+"&x="+V_CUT_X+"&y="+V_CUT_Y+"&w="+V_CUT_W+"&h="+V_CUT_H;
			}//;

		break;
		
		default:
		break;
	}
		return imgArray;
	}