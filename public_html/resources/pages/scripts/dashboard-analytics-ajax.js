var Dashboard = function() {
	return {
		initDashboardDaterange: function() {
			if (!jQuery().daterangepicker) {
				return;
			}
			$('#dashboard-report-range').daterangepicker({
				"ranges": {
				// 'Today': [moment(), moment()],
				// 'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
				'Last 7 Days': [moment().subtract('days', 7), moment()],
				'Last 30 Days': [moment().subtract('days', 29), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
			},
			"locale": {
				"format": "MM/DD/YYYY",
				"separator": " - ",
				"applyLabel": "Apply",
				"cancelLabel": "Cancel",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"daysOfWeek": [
					"Su",
					"Mo",
					"Tu",
					"We",
					"Th",
					"Fr",
					"Sa"
				],
				"monthNames": [
					"January",
					"February",
					"March",
					"April",
					"May",
					"June",
					"July",
					"August",
					"September",
					"October",
					"November",
					"December"
				],
				"firstDay": 1
			},
			//"startDate": "11/08/2015",
			//"endDate": "11/14/2015",
			opens: (App.isRTL() ? 'right' : 'left'),
		}, function(start, end, label) {
			$('#dashboard-report-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		});
		$('#dashboard-report-range span').html(moment().subtract('days', 7).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
		$('#dashboard-report-range').show();
	},
	loadVisitorPlotChart:function(visitors,range_leads){	
		function showChartTooltip(x, y, xValue, yValue) {
			$('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
				position: 'absolute',
				display: 'none',
				top: y - 40,
				left: x - 40,
				border: '0px solid #ccc',
				padding: '2px 6px',
				'background-color': '#fff'
			}).appendTo("body").fadeIn(200);
		}
		$('#site_statistics_loading').hide();
		$('#site_statistics_content').show();
		visitors=jQuery.parseJSON(visitors);
		var plot_statistics = $.plot($("#site_statistics"), [{			
			data: visitors,
			lines: {
				fill: 0.6,
				lineWidth: 0
			},
			color: ['#f89f9f']
			}, {
			data: visitors,
			points: {
				show: true,
				fill: true,
				radius: 5,
				fillColor: "#f89f9f",
				lineWidth: 3
			},
			color: '#fff',
				shadowSize: 0
			}],
			{
				xaxis: {
					tickLength: 0,
					tickDecimals: 0,
					mode: "categories",
					min: 0,
					font: {
						lineHeight: 14,
						style: "normal",
						variant: "small-caps",
						color: "#6F7B8A"
					}
				},
				yaxis: {
					ticks: 5,
					tickDecimals: 0,
					tickColor: "#eee",
					font: {
						lineHeight: 14,
						style: "normal",
						variant: "small-caps",
						color: "#6F7B8A"
					}
				},
				grid: {
					hoverable: true,
					clickable: true,
					tickColor: "#eee",
					borderColor: "#eee",
					borderWidth: 1
				}
			});
			var previousPoint = null;
				$("#site_statistics").bind("plothover", function(event, pos, item) {
					$("#x").text(pos.x.toFixed(2));
					$("#y").text(pos.y.toFixed(2));
					if (item) {
						if (previousPoint != item.dataIndex) {
							previousPoint = item.dataIndex;
							$("#tooltip").remove();
							var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);
							showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + ' visits');
						}
					} else {
						$("#tooltip").remove();
						previousPoint = null;
					}
				});
				/*
				although ammap has methos like getAreaCenterLatitude and getAreaCenterLongitude,
				they are not suitable in quite a lot of cases as the center of some countries
				is even outside the country itself (like US, because of Alaska and Hawaii)
				That's why wehave the coordinates stored here
				*/
				var latlong = {};
				latlong["AD"] = {
					"latitude": 42.5,
					"longitude": 1.5
				};
				latlong["AE"] = {
					"latitude": 24,
					"longitude": 54
				};
				latlong["AF"] = {
					"latitude": 33,
					"longitude": 65
				};
				latlong["AG"] = {
					"latitude": 17.05,
					"longitude": -61.8
				};
				latlong["AI"] = {
					"latitude": 18.25,
					"longitude": -63.1667
				};
				latlong["AL"] = {
					"latitude": 41,
					"longitude": 20
				};
				latlong["AM"] = {
					"latitude": 40,
					"longitude": 45
				};
				latlong["AN"] = {
					"latitude": 12.25,
					"longitude": -68.75
				};
				latlong["AO"] = {
					"latitude": -12.5,
					"longitude": 18.5
				};
				latlong["AP"] = {
					"latitude": 35,
					"longitude": 105
				};
				latlong["AQ"] = {
					"latitude": -90,
					"longitude": 0
				};
				latlong["AR"] = {
					"latitude": -34,
					"longitude": -64
				};
				latlong["AS"] = {
					"latitude": -14.3333,
					"longitude": -170
				};
				latlong["AT"] = {
					"latitude": 47.3333,
					"longitude": 13.3333
				};
				latlong["AU"] = {
					"latitude": -27,
					"longitude": 133
				};
				latlong["AW"] = {
					"latitude": 12.5,
					"longitude": -69.9667
				};
				latlong["AZ"] = {
					"latitude": 40.5,
					"longitude": 47.5
				};
				latlong["BA"] = {
					"latitude": 44,
					"longitude": 18
				};
				latlong["BB"] = {
					"latitude": 13.1667,
					"longitude": -59.5333
				};
				latlong["BD"] = {
					"latitude": 24,
					"longitude": 90
				};
				latlong["BE"] = {
					"latitude": 50.8333,
					"longitude": 4
				};
				latlong["BF"] = {
					"latitude": 13,
					"longitude": -2
				};
				latlong["BG"] = {
					"latitude": 43,
					"longitude": 25
				};
				latlong["BH"] = {
					"latitude": 26,
					"longitude": 50.55
				};
				latlong["BI"] = {
					"latitude": -3.5,
					"longitude": 30
				};
				latlong["BJ"] = {
					"latitude": 9.5,
					"longitude": 2.25
				};
				latlong["BM"] = {
					"latitude": 32.3333,
					"longitude": -64.75
				};
				latlong["BN"] = {
					"latitude": 4.5,
					"longitude": 114.6667
				};
				latlong["BO"] = {
					"latitude": -17,
					"longitude": -65
				};
				latlong["BR"] = {
					"latitude": -10,
					"longitude": -55
				};
				latlong["BS"] = {
					"latitude": 24.25,
					"longitude": -76
				};
				latlong["BT"] = {
					"latitude": 27.5,
					"longitude": 90.5
				};
				latlong["BV"] = {
					"latitude": -54.4333,
					"longitude": 3.4
				};
				latlong["BW"] = {
					"latitude": -22,
					"longitude": 24
				};
				latlong["BY"] = {
					"latitude": 53,
					"longitude": 28
				};
				latlong["BZ"] = {
					"latitude": 17.25,
					"longitude": -88.75
				};
				latlong["CA"] = {
					"latitude": 54,
					"longitude": -100
				};
				latlong["CC"] = {
					"latitude": -12.5,
					"longitude": 96.8333
				};
				latlong["CD"] = {
					"latitude": 0,
					"longitude": 25
				};
				latlong["CF"] = {
					"latitude": 7,
					"longitude": 21
				};
				latlong["CG"] = {
					"latitude": -1,
					"longitude": 15
				};
				latlong["CH"] = {
					"latitude": 47,
					"longitude": 8
				};
				latlong["CI"] = {
					"latitude": 8,
					"longitude": -5
				};
				latlong["CK"] = {
					"latitude": -21.2333,
					"longitude": -159.7667
				};
				latlong["CL"] = {
					"latitude": -30,
					"longitude": -71
				};
				latlong["CM"] = {
					"latitude": 6,
					"longitude": 12
				};
				latlong["CN"] = {
					"latitude": 35,
					"longitude": 105
				};
				latlong["CO"] = {
						"latitude": 4,
						"longitude": -72
				};
				latlong["CR"] = {
					"latitude": 10,
					"longitude": -84
				};
				latlong["CU"] = {
					"latitude": 21.5,
					"longitude": -80
				};
				latlong["CV"] = {
					"latitude": 16,
					"longitude": -24
				};
				latlong["CX"] = {
					"latitude": -10.5,
					"longitude": 105.6667
				};
				latlong["CY"] = {
					"latitude": 35,
					"longitude": 33
				};
				latlong["CZ"] = {
					"latitude": 49.75,
					"longitude": 15.5
				};
				latlong["DE"] = {
					"latitude": 51,
					"longitude": 9
				};
				latlong["DJ"] = {
					"latitude": 11.5,
					"longitude": 43
				};
				latlong["DK"] = {
					"latitude": 56,
					"longitude": 10
				};
				latlong["DM"] = {
					"latitude": 15.4167,
					"longitude": -61.3333
				};
				latlong["DO"] = {
					"latitude": 19,
					"longitude": -70.6667
				};
				latlong["DZ"] = {
					"latitude": 28,
					"longitude": 3
				};
				latlong["EC"] = {
					"latitude": -2,
					"longitude": -77.5
				};
				latlong["EE"] = {
					"latitude": 59,
					"longitude": 26
				};
				latlong["EG"] = {
					"latitude": 27,
					"longitude": 30
				};
				latlong["EH"] = {
					"latitude": 24.5,
					"longitude": -13
				};
				latlong["ER"] = {
					"latitude": 15,
					"longitude": 39
				};
				latlong["ES"] = {
					"latitude": 40,
					"longitude": -4
				};
				latlong["ET"] = {
					"latitude": 8,
					"longitude": 38
				};
				latlong["EU"] = {
					"latitude": 47,
					"longitude": 8
				};
				latlong["FI"] = {
					"latitude": 62,
					"longitude": 26
				};
				latlong["FJ"] = {
					"latitude": -18,
					"longitude": 175
				};
				latlong["FK"] = {
					"latitude": -51.75,
					"longitude": -59
				};
				latlong["FM"] = {
					"latitude": 6.9167,
					"longitude": 158.25
				};
				latlong["FO"] = {
					"latitude": 62,
					"longitude": -7
				};
				latlong["FR"] = {
					"latitude": 46,
					"longitude": 2
				};
				latlong["GA"] = {
					"latitude": -1,
					"longitude": 11.75
				};
				latlong["GB"] = {
					"latitude": 54,
					"longitude": -2
				};
				latlong["GD"] = {
					"latitude": 12.1167,
					"longitude": -61.6667
				};
				latlong["GE"] = {
					"latitude": 42,
					"longitude": 43.5
				};
				latlong["GF"] = {
					"latitude": 4,
					"longitude": -53
				};
				latlong["GH"] = {
					"latitude": 8,
					"longitude": -2
				};
				latlong["GI"] = {
					"latitude": 36.1833,
					"longitude": -5.3667
				};
				latlong["GL"] = {
					"latitude": 72,
					"longitude": -40
				};
				latlong["GM"] = {
					"latitude": 13.4667,
					"longitude": -16.5667
				};
				latlong["GN"] = {
					"latitude": 11,
					"longitude": -10
				};
				latlong["GP"] = {
					"latitude": 16.25,
					"longitude": -61.5833
				};
				latlong["GQ"] = {
					"latitude": 2,
					"longitude": 10
				};
				latlong["GR"] = {
					"latitude": 39,
					"longitude": 22
				};
				latlong["GS"] = {
					"latitude": -54.5,
					"longitude": -37
				};
				latlong["GT"] = {
					"latitude": 15.5,
					"longitude": -90.25
				};
				latlong["GU"] = {
					"latitude": 13.4667,
					"longitude": 144.7833
				};
				latlong["GW"] = {
					"latitude": 12,
					"longitude": -15
				};
				latlong["GY"] = {
					"latitude": 5,
					"longitude": -59
				};
				latlong["HK"] = {
					"latitude": 22.25,
					"longitude": 114.1667
				};
				latlong["HM"] = {
					"latitude": -53.1,
					"longitude": 72.5167
				};
				latlong["HN"] = {
					"latitude": 15,
					"longitude": -86.5
				};
				latlong["HR"] = {
					"latitude": 45.1667,
					"longitude": 15.5
				};
				latlong["HT"] = {
					"latitude": 19,
					"longitude": -72.4167
				};
				latlong["HU"] = {
					"latitude": 47,
					"longitude": 20
				};
				latlong["ID"] = {
					"latitude": -5,
					"longitude": 120
				};
				latlong["IE"] = {
					"latitude": 53,
					"longitude": -8
				};
				latlong["IL"] = {
					"latitude": 31.5,
					"longitude": 34.75
				};
				latlong["IN"] = {
					"latitude": 20,
					"longitude": 77
				};
				latlong["IO"] = {
					"latitude": -6,
					"longitude": 71.5
				};
				latlong["IQ"] = {
					"latitude": 33,
					"longitude": 44
				};
				latlong["IR"] = {
					"latitude": 32,
					"longitude": 53
				};
				latlong["IS"] = {
					"latitude": 65,
					"longitude": -18
				};
				latlong["IT"] = {
					"latitude": 42.8333,
					"longitude": 12.8333
				};
				latlong["JM"] = {
					"latitude": 18.25,
					"longitude": -77.5
				};
				latlong["JO"] = {
					"latitude": 31,
					"longitude": 36
				};
				latlong["JP"] = {
					"latitude": 36,
					"longitude": 138
				};
				latlong["KE"] = {
					"latitude": 1,
					"longitude": 38
				};
				latlong["KG"] = {
					"latitude": 41,
					"longitude": 75
				};
				latlong["KH"] = {
					"latitude": 13,
					"longitude": 105
				};
				latlong["KI"] = {
						"latitude": 1.4167,
						"longitude": 173
				};
				latlong["KM"] = {
						"latitude": -12.1667,
						"longitude": 44.25
				};
				latlong["KN"] = {
						"latitude": 17.3333,
						"longitude": -62.75
				};
				latlong["KP"] = {
						"latitude": 40,
						"longitude": 127
				};
				latlong["KR"] = {
						"latitude": 37,
						"longitude": 127.5
				};
				latlong["KW"] = {
						"latitude": 29.3375,
						"longitude": 47.6581
				};
				latlong["KY"] = {
						"latitude": 19.5,
						"longitude": -80.5
				};
				latlong["KZ"] = {
						"latitude": 48,
						"longitude": 68
				};
				latlong["LA"] = {
						"latitude": 18,
						"longitude": 105
				};
				latlong["LB"] = {
						"latitude": 33.8333,
						"longitude": 35.8333
				};
				latlong["LC"] = {
						"latitude": 13.8833,
						"longitude": -61.1333
				};
				latlong["LI"] = {
						"latitude": 47.1667,
						"longitude": 9.5333
				};
				latlong["LK"] = {
						"latitude": 7,
						"longitude": 81
				};
				latlong["LR"] = {
						"latitude": 6.5,
						"longitude": -9.5
				};
				latlong["LS"] = {
						"latitude": -29.5,
						"longitude": 28.5
				};
				latlong["LT"] = {
						"latitude": 55,
						"longitude": 24
				};
				latlong["LU"] = {
						"latitude": 49.75,
						"longitude": 6
				};
				latlong["LV"] = {
						"latitude": 57,
						"longitude": 25
				};
				latlong["LY"] = {
						"latitude": 25,
						"longitude": 17
				};
				latlong["MA"] = {
						"latitude": 32,
						"longitude": -5
				};
				latlong["MC"] = {
						"latitude": 43.7333,
						"longitude": 7.4
				};
				latlong["MD"] = {
						"latitude": 47,
						"longitude": 29
				};
				latlong["ME"] = {
						"latitude": 42.5,
						"longitude": 19.4
				};
				latlong["MG"] = {
						"latitude": -20,
						"longitude": 47
				};
				latlong["MH"] = {
						"latitude": 9,
						"longitude": 168
				};
				latlong["MK"] = {
						"latitude": 41.8333,
						"longitude": 22
				};
				latlong["ML"] = {
						"latitude": 17,
						"longitude": -4
				};
				latlong["MM"] = {
						"latitude": 22,
						"longitude": 98
				};
				latlong["MN"] = {
						"latitude": 46,
						"longitude": 105
				};
				latlong["MO"] = {
						"latitude": 22.1667,
						"longitude": 113.55
				};
				latlong["MP"] = {
						"latitude": 15.2,
						"longitude": 145.75
				};
				latlong["MQ"] = {
						"latitude": 14.6667,
						"longitude": -61
				};
				latlong["MR"] = {
						"latitude": 20,
						"longitude": -12
				};
				latlong["MS"] = {
						"latitude": 16.75,
						"longitude": -62.2
				};
				latlong["MT"] = {
						"latitude": 35.8333,
						"longitude": 14.5833
				};
				latlong["MU"] = {
						"latitude": -20.2833,
						"longitude": 57.55
				};
				latlong["MV"] = {
						"latitude": 3.25,
						"longitude": 73
				};
				latlong["MW"] = {
						"latitude": -13.5,
						"longitude": 34
				};
				latlong["MX"] = {
						"latitude": 23,
						"longitude": -102
				};
				latlong["MY"] = {
						"latitude": 2.5,
						"longitude": 112.5
				};
				latlong["MZ"] = {
						"latitude": -18.25,
						"longitude": 35
				};
				latlong["NA"] = {
						"latitude": -22,
						"longitude": 17
				};
				latlong["NC"] = {
						"latitude": -21.5,
						"longitude": 165.5
				};
				latlong["NE"] = {
						"latitude": 16,
						"longitude": 8
				};
				latlong["NF"] = {
						"latitude": -29.0333,
						"longitude": 167.95
				};
				latlong["NG"] = {
						"latitude": 10,
						"longitude": 8
				};
				latlong["NI"] = {
						"latitude": 13,
						"longitude": -85
				};
				latlong["NL"] = {
						"latitude": 52.5,
						"longitude": 5.75
				};
				latlong["NO"] = {
						"latitude": 62,
						"longitude": 10
				};
				latlong["NP"] = {
						"latitude": 28,
						"longitude": 84
				};
				latlong["NR"] = {
						"latitude": -0.5333,
						"longitude": 166.9167
				};
				latlong["NU"] = {
						"latitude": -19.0333,
						"longitude": -169.8667
				};
				latlong["NZ"] = {
						"latitude": -41,
						"longitude": 174
				};
				latlong["OM"] = {
						"latitude": 21,
						"longitude": 57
				};
				latlong["PA"] = {
						"latitude": 9,
						"longitude": -80
				};
				latlong["PE"] = {
						"latitude": -10,
						"longitude": -76
				};
				latlong["PF"] = {
						"latitude": -15,
						"longitude": -140
				};
				latlong["PG"] = {
						"latitude": -6,
						"longitude": 147
				};
				latlong["PH"] = {
						"latitude": 13,
						"longitude": 122
				};
				latlong["PK"] = {
						"latitude": 30,
						"longitude": 70
				};
				latlong["PL"] = {
						"latitude": 52,
						"longitude": 20
				};
				latlong["PM"] = {
						"latitude": 46.8333,
						"longitude": -56.3333
				};
				latlong["PR"] = {
						"latitude": 18.25,
						"longitude": -66.5
				};
				latlong["PS"] = {
						"latitude": 32,
						"longitude": 35.25
				};
				latlong["PT"] = {
						"latitude": 39.5,
						"longitude": -8
				};
				latlong["PW"] = {
						"latitude": 7.5,
						"longitude": 134.5
				};
				latlong["PY"] = {
						"latitude": -23,
						"longitude": -58
				};
				latlong["QA"] = {
						"latitude": 25.5,
						"longitude": 51.25
				};
				latlong["RE"] = {
						"latitude": -21.1,
						"longitude": 55.6
				};
				latlong["RO"] = {
					"latitude": 46,
					"longitude": 25
				};
				latlong["RS"] = {
					"latitude": 44,
					"longitude": 21
				};
				latlong["RU"] = {
					"latitude": 60,
					"longitude": 100
				};
				latlong["RW"] = {
					"latitude": -2,
					"longitude": 30
				};
				latlong["SA"] = {
					"latitude": 25,
					"longitude": 45
				};
				latlong["SB"] = {
					"latitude": -8,
					"longitude": 159
				};
				latlong["SC"] = {
					"latitude": -4.5833,
					"longitude": 55.6667
				};
				latlong["SD"] = {
					"latitude": 15,
					"longitude": 30
				};
				latlong["SE"] = {
					"latitude": 62,
					"longitude": 15
				};
				latlong["SG"] = {
					"latitude": 1.3667,
					"longitude": 103.8
				};
				latlong["SH"] = {
					"latitude": -15.9333,
					"longitude": -5.7
				};
				latlong["SI"] = {
					"latitude": 46,
					"longitude": 15
				};
				latlong["SJ"] = {
					"latitude": 78,
					"longitude": 20
				};
				latlong["SK"] = {
					"latitude": 48.6667,
					"longitude": 19.5
				};
				latlong["SL"] = {
					"latitude": 8.5,
					"longitude": -11.5
				};
				latlong["SM"] = {
					"latitude": 43.7667,
					"longitude": 12.4167
				};
				latlong["SN"] = {
					"latitude": 14,
					"longitude": -14
				};
				latlong["SO"] = {
					"latitude": 10,
					"longitude": 49
				};
				latlong["SR"] = {
					"latitude": 4,
					"longitude": -56
				};
				latlong["ST"] = {
					"latitude": 1,
					"longitude": 7
				};
				latlong["SV"] = {
					"latitude": 13.8333,
					"longitude": -88.9167
				};
				latlong["SY"] = {
					"latitude": 35,
					"longitude": 38
				};
				latlong["SZ"] = {
					"latitude": -26.5,
					"longitude": 31.5
				};
				latlong["TC"] = {
					"latitude": 21.75,
					"longitude": -71.5833
				};
				latlong["TD"] = {
					"latitude": 15,
					"longitude": 19
				};
				latlong["TF"] = {
					"latitude": -43,
					"longitude": 67
				};
				latlong["TG"] = {
					"latitude": 8,
					"longitude": 1.1667
				};
				latlong["TH"] = {
					"latitude": 15,
					"longitude": 100
				};
				latlong["TJ"] = {
					"latitude": 39,
					"longitude": 71
				};
				latlong["TK"] = {
					"latitude": -9,
					"longitude": -172
				};
				latlong["TM"] = {
					"latitude": 40,
					"longitude": 60
				};
				latlong["TN"] = {
					"latitude": 34,
					"longitude": 9
				};
				latlong["TO"] = {
					"latitude": -20,
					"longitude": -175
				};
				latlong["TR"] = {
					"latitude": 39,
					"longitude": 35
				};
				latlong["TT"] = {
					"latitude": 11,
					"longitude": -61
				};
				latlong["TV"] = {
					"latitude": -8,
					"longitude": 178
				};
				latlong["TW"] = {
					"latitude": 23.5,
					"longitude": 121
				};
				latlong["TZ"] = {
					"latitude": -6,
					"longitude": 35
				};
				latlong["UA"] = {
					"latitude": 49,
					"longitude": 32
				};
				latlong["UG"] = {
					"latitude": 1,
					"longitude": 32
				};
				latlong["UM"] = {
					"latitude": 19.2833,
					"longitude": 166.6
				};
				latlong["US"] = {
					"latitude": 38,
					"longitude": -97
				};
				latlong["UY"] = {
					"latitude": -33,
					"longitude": -56
				};
				latlong["UZ"] = {
					"latitude": 41,
					"longitude": 64
				};
				latlong["VA"] = {
					"latitude": 41.9,
					"longitude": 12.45
				};
				latlong["VC"] = {
					"latitude": 13.25,
					"longitude": -61.2
				};
				latlong["VE"] = {
					"latitude": 8,
					"longitude": -66
				};
				latlong["VG"] = {
					"latitude": 18.5,
					"longitude": -64.5
				};
				latlong["VI"] = {
					"latitude": 18.3333,
					"longitude": -64.8333
				};
				latlong["VN"] = {
					"latitude": 16,
					"longitude": 106
				};
				latlong["VU"] = {
					"latitude": -16,
					"longitude": 167
				};
				latlong["WF"] = {
					"latitude": -13.3,
					"longitude": -176.2
				};
				latlong["WS"] = {
					"latitude": -13.5833,
					"longitude": -172.3333
				};
				latlong["YE"] = {
					"latitude": 15,
					"longitude": 48
				};
				latlong["YT"] = {
					"latitude": -12.8333,
					"longitude": 45.1667
				};
				latlong["ZA"] = {
					"latitude": -29,
					"longitude": 24
				};
				latlong["ZM"] = {
					"latitude": -15,
					"longitude": 30
				};
				latlong["ZW"] = {
					"latitude": -20,
					"longitude": 30
				};
				var mapData = jQuery.parseJSON(locationUser);
				var map;
				var minBulletSize = 3;
				var maxBulletSize = 70;
				var min = Infinity;
				var max = -Infinity;
				// get min and max values
				for (var i = 0; i < mapData.length; i++) {
					var value = mapData[i].value;
					if (value < min) {
						min = value;
					}
					if (value > max) {
						max = value;
					}
				}
				// build map
				AmCharts.ready(function() {
					AmCharts.theme = AmCharts.themes.dark;
					map = new AmCharts.AmMap();
					map.pathToImages = App.getGlobalPluginsPath() + "amcharts/ammap/images/",
					map.fontFamily = 'Open Sans';
					map.fontSize = '13';
					map.color = '#888';
					map.addTitle("Global Hits", 14);						
					map.areasSettings = {
						unlistedAreasColor: "#000000",
						unlistedAreasAlpha: 0.1
					};
					map.imagesSettings.balloonText = "<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>";
					var dataProvider = {
						mapVar: AmCharts.maps.worldLow,
						images: []
					}
					// create circle for each country
					for (var i = 0; i < mapData.length; i++) {
						var dataItem = mapData[i];
						var value = dataItem.value;
						// calculate size of a bubble
						var size = (value - min) / (max - min) * (maxBulletSize - minBulletSize) + minBulletSize;
						if (size < minBulletSize) {
							size = minBulletSize;
						}
						var id = dataItem.code;
						dataProvider.images.push({
							type: "circle",
							width: size,
							height: size,
							color: dataItem.color,
							longitude: latlong[id].longitude,
							latitude: latlong[id].latitude,
							title: dataItem.name,
							value: value
						});
					}
					map.dataProvider = dataProvider;
					map.write("chart_10");
				});
				$('#chart_10').closest('.portlet').find('.fullscreen').click(function() {
					map.invalidateSize();
				});
			},
		init: function() {			
			this.initDashboardDaterange();
			this.loadVisitorPlotChart(visitors,range_leads);
		}
	};
}();
var ChartLoad = function () {
	// private functions & variables
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	var myFunc = function(text) {
		alert(text);
	} 
	// public functions
	return {
		//main function
		init: function () {
			$('#dashboard-report-range').on('apply.daterangepicker', function() {							
				var start = $('[name=daterangepicker_start]').val();
				var end = $('[name=daterangepicker_end]').val();
				ChartLoad.getAnalyticsPlotChart(start,end)
			});
		}, 
		getAnalyticsPlotChart : function(start,end){					
			jQuery.ajax({
				type: "POST",
				url: site_url+'/analytics/get_range_analysis',
				data: {
					"start": start,
					"end" : end
				},
				async: false,        
				success: function(result)
				{
					Dashboard.loadVisitorPlotChart(result['weekHits'],result['leads']);
				}
			});
		}
	};
}();
function loadPieChart(){
	var chart = AmCharts.makeChart("chart_browser_hits", {
		"type": "pie",
		"theme": "light",
		"fontFamily": 'Open Sans',            
		"color":    '#888',
		"dataProvider": jQuery.parseJSON(topBrowserPie),
		"valueField": "Hits",
		"titleField": "Browser",
		"exportConfig": {
			menuItems: [{
				icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
				format: 'png'
			}]
		}
});
$('#chart_browser_hits').closest('.portlet').find('.fullscreen').click(function() {
	chart.invalidateSize();
});
var chart = AmCharts.makeChart("chart_os_hits", {
	"type": "pie",
	"theme": "light",
	"fontFamily": 'Open Sans',            
	"color":    '#888',
	"dataProvider": jQuery.parseJSON(topOsPie),
	"valueField": "Hits",
	"titleField": "Os",
	"exportConfig": {
		menuItems: [{
			icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
			format: 'png'
		}]
	}
});
$('#chart_os_hits').closest('.portlet').find('.fullscreen').click(function() {
	chart.invalidateSize();
});
var chart = AmCharts.makeChart("chart_vistor_hits", {
	"type": "pie",
	"theme": "light",
	"fontFamily": 'Open Sans',            
	"color":    '#888',
	"dataProvider": jQuery.parseJSON(topVisitorPie),
	"valueField": "Hits",
	"titleField": "Os",
	"exportConfig": {
		menuItems: [{
			icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
			format: 'png'
		}]
	}
});
$('#chart_vistor_hits').closest('.portlet').find('.fullscreen').click(function() {
	chart.invalidateSize();
});
}
jQuery(document).ready(function() {	
	Dashboard.init(); 
	ChartLoad.init();	
	loadPieChart();
});