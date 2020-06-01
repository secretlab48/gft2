function check_checkbox ( el ) {
    var checked = false;

    if ( jQuery(el).is(':checked') ) {
        checked = true;
    }

    return checked ? true : false;
}

jQuery(document).ready( function( $ ) {


    var countries =
        [
            {"id":"1","long_name":"Afghanistan","short_name":"AF","center_lat":"33.939110","center_lng":"67.709953","sw_lat":"29.377200","sw_lng":"60.517000","ne_lat":"38.490877","ne_lng":"74.889862"},
            {"id":"2","long_name":"Albania","short_name":"AL","center_lat":"41.153332","center_lng":"20.168331","sw_lat":"39.644730","sw_lng":"19.263904","ne_lat":"42.661082","ne_lng":"21.057239"},
            {"id":"3","long_name":"Algeria","short_name":"DZ","center_lat":"28.033886","center_lng":"1.659626","sw_lat":"18.968147","sw_lng":"-8.666667","ne_lat":"37.089821","ne_lng":"12.000000"},
            {"id":"4","long_name":"Andorra","short_name":"AD","center_lat":"42.506285","center_lng":"1.521801","sw_lat":"42.428749","sw_lng":"1.408705","ne_lat":"42.655791","ne_lng":"1.786639"},
            {"id":"5","long_name":"Angola","short_name":"AO","center_lat":"-11.202692","center_lng":"17.873887","sw_lat":"-18.039104","sw_lng":"11.669562","ne_lat":"-4.387944","ne_lng":"24.084444"},
            {"id":"6","long_name":"Antigua","short_name":"Antigua","center_lat":"17.074656","center_lng":"-61.817521","sw_lat":"16.997626","sw_lng":"-61.906251","ne_lat":"17.173760","ne_lng":"-61.673155"},
            {"id":"7","long_name":"Argentina","short_name":"AR","center_lat":"-38.416097","center_lng":"-63.616672","sw_lat":"-55.057715","sw_lng":"-73.560360","ne_lat":"-21.780814","ne_lng":"-53.637481"},
            {"id":"8","long_name":"Armenia","short_name":"AM","center_lat":"40.069099","center_lng":"45.038189","sw_lat":"38.840244","sw_lng":"43.447212","ne_lat":"41.300993","ne_lng":"46.634222"},
            {"id":"9","long_name":"Australia","short_name":"AU","center_lat":"-25.274398","center_lng":"133.775136","sw_lat":"-54.777219","sw_lng":"112.921454","ne_lat":"-9.221084","ne_lng":"159.255528"},
            {"id":"10","long_name":"Austria","short_name":"AT","center_lat":"47.516231","center_lng":"14.550072","sw_lat":"46.372336","sw_lng":"9.530783","ne_lat":"49.020608","ne_lng":"17.160686"},
            {"id":"11","long_name":"Azerbaijan","short_name":"AZ","center_lat":"40.143105","center_lng":"47.576927","sw_lat":"38.391990","sw_lng":"44.764683","ne_lat":"41.912340","ne_lng":"50.467866"},
            {"id":"12","long_name":"The Bahamas","short_name":"BS","center_lat":"25.034280","center_lng":"-77.396280","sw_lat":"20.912131","sw_lng":"-80.474947","ne_lat":"27.263362","ne_lng":"-72.712069"},
            {"id":"13","long_name":"Bahrain","short_name":"BH","center_lat":"26.066700","center_lng":"50.557700","sw_lat":"25.556458","sw_lng":"50.378151","ne_lat":"26.330394","ne_lng":"50.824846"},
            {"id":"14","long_name":"Bangladesh","short_name":"BD","center_lat":"23.684994","center_lng":"90.356331","sw_lat":"20.754380","sw_lng":"88.008589","ne_lat":"26.634243","ne_lng":"92.680115"},
            {"id":"15","long_name":"Barbados","short_name":"BB","center_lat":"13.193887","center_lng":"-59.543198","sw_lat":"13.045000","sw_lng":"-59.651030","ne_lat":"13.335126","ne_lng":"-59.420098"},
            {"id":"16","long_name":"Belarus","short_name":"BY","center_lat":"53.709807","center_lng":"27.953389","sw_lat":"51.262011","sw_lng":"23.178338","ne_lat":"56.171872","ne_lng":"32.776820"},
            {"id":"17","long_name":"Belgium","short_name":"BE","center_lat":"50.503887","center_lng":"4.469936","sw_lat":"49.497013","sw_lng":"2.544795","ne_lat":"51.505145","ne_lng":"6.408124"},
            {"id":"18","long_name":"Belize","short_name":"BZ","center_lat":"17.189877","center_lng":"-88.497650","sw_lat":"15.885619","sw_lng":"-89.227588","ne_lat":"18.495942","ne_lng":"-87.491727"},
            {"id":"19","long_name":"Benin","short_name":"BJ","center_lat":"9.307690","center_lng":"2.315834","sw_lat":"6.234832","sw_lng":"0.776667","ne_lat":"12.408611","ne_lng":"3.843343"},
            {"id":"20","long_name":"Bhutan","short_name":"BT","center_lat":"27.514162","center_lng":"90.433601","sw_lat":"26.702016","sw_lng":"88.746473","ne_lat":"28.360825","ne_lng":"92.125232"},
            {"id":"21","long_name":"Bolivia","short_name":"BO","center_lat":"-16.290154","center_lng":"-63.588653","sw_lat":"-22.898090","sw_lng":"-69.644990","ne_lat":"-9.669323","ne_lng":"-57.453803"},
            {"id":"22","long_name":"Botswana","short_name":"BW","center_lat":"-22.328474","center_lng":"24.684866","sw_lat":"-26.907545","sw_lng":"19.998905","ne_lat":"-17.778137","ne_lng":"29.375304"},
            {"id":"23","long_name":"Brazil","short_name":"BR","center_lat":"-14.235004","center_lng":"-51.925280","sw_lat":"-33.751748","sw_lng":"-73.982817","ne_lat":"5.271602","ne_lng":"-29.345024"},
            {"id":"24","long_name":"Brunei","short_name":"BN","center_lat":"4.535277","center_lng":"114.727669","sw_lat":"4.002508","sw_lng":"114.076063","ne_lat":"5.082646","ne_lng":"115.363562"},
            {"id":"25","long_name":"Bulgaria","short_name":"BG","center_lat":"42.733883","center_lng":"25.485830","sw_lat":"41.235447","sw_lng":"22.357345","ne_lat":"44.215233","ne_lng":"28.609263"},
            {"id":"26","long_name":"Burkina Faso","short_name":"BF","center_lat":"12.238333","center_lng":"-1.561593","sw_lat":"9.393889","sw_lng":"-5.521111","ne_lat":"15.085111","ne_lng":"2.404293"},
            {"id":"27","long_name":"Burundi","short_name":"BI","center_lat":"-3.373056","center_lng":"29.918886","sw_lat":"-4.469228","sw_lng":"29.000993","ne_lat":"-2.309987","ne_lng":"30.850173"},
            {"id":"28","long_name":"Cambodia","short_name":"KH","center_lat":"12.565679","center_lng":"104.990963","sw_lat":"9.276808","sw_lng":"102.333542","ne_lat":"14.690179","ne_lng":"107.627687"},
            {"id":"29","long_name":"Cameroon","short_name":"CM","center_lat":"7.369722","center_lng":"12.354722","sw_lat":"1.655900","sw_lng":"8.494763","ne_lat":"13.083335","ne_lng":"16.194408"},
            {"id":"30","long_name":"Canada","short_name":"CA","center_lat":"56.130366","center_lng":"-106.346771","sw_lat":"41.676556","sw_lng":"-141.001870","ne_lat":"83.115061","ne_lng":"-52.619409"},
            {"id":"31","long_name":"Cape Verde","short_name":"CV","center_lat":"15.120142","center_lng":"-23.605172","sw_lat":"14.802351","sw_lng":"-25.360994","ne_lat":"17.205287","ne_lng":"-22.657778"},
            {"id":"32","long_name":"Chad","short_name":"TD","center_lat":"15.454166","center_lng":"18.732207","sw_lat":"7.442975","sw_lng":"13.470000","ne_lat":"23.449235","ne_lng":"24.000001"},
            {"id":"33","long_name":"Chile","short_name":"CL","center_lat":"-35.675147","center_lng":"-71.542969","sw_lat":"-55.979781","sw_lng":"-109.454881","ne_lat":"-17.498329","ne_lng":"-66.418202"},
            {"id":"34","long_name":"China","short_name":"CN","center_lat":"35.861660","center_lng":"104.195397","sw_lat":"18.153522","sw_lng":"73.499414","ne_lat":"53.560974","ne_lng":"134.772810"},
            {"id":"35","long_name":"Colombia","short_name":"CO","center_lat":"4.570868","center_lng":"-74.297333","sw_lat":"-4.227110","sw_lng":"-81.735930","ne_lat":"13.397350","ne_lng":"-66.851923"},
            {"id":"36","long_name":"Comoros","short_name":"KM","center_lat":"-11.645500","center_lng":"43.333300","sw_lat":"-12.413821","sw_lng":"43.219421","ne_lat":"-11.364639","ne_lng":"44.540570"},
            {"id":"37","long_name":"Congo","short_name":"CG","center_lat":"-0.228021","center_lng":"15.827659","sw_lat":"-5.028949","sw_lng":"11.149548","ne_lat":"3.707791","ne_lng":"18.643611"},
            {"id":"38","long_name":"Costa Rica","short_name":"CR","center_lat":"9.748917","center_lng":"-83.753428","sw_lat":"5.499153","sw_lng":"-87.094513","ne_lat":"11.219681","ne_lng":"-82.552657"},
            {"id":"39","long_name":"Croatia","short_name":"HR","center_lat":"45.100000","center_lng":"15.200000","sw_lat":"42.392265","sw_lng":"13.489691","ne_lat":"46.555223","ne_lng":"19.448052"},
            {"id":"40","long_name":"Cuba","short_name":"CU","center_lat":"21.521757","center_lng":"-77.781167","sw_lat":"19.825899","sw_lng":"-85.071247","ne_lat":"23.276752","ne_lng":"-74.132223"},
            {"id":"41","long_name":"Cyprus","short_name":"CY","center_lat":"35.126413","center_lng":"33.429859","sw_lat":"34.632303","sw_lng":"32.268708","ne_lat":"35.707200","ne_lng":"34.604500"},
            {"id":"42","long_name":"Czech Republic","short_name":"CZ","center_lat":"49.817492","center_lng":"15.472962","sw_lat":"48.551808","sw_lng":"12.090589","ne_lat":"51.055719","ne_lng":"18.859236"},
            {"id":"43","long_name":"Denmark","short_name":"DK","center_lat":"56.1554671","center_lng":"10.4309955","sw_lat":"54.464597","sw_lng":"8.072241","ne_lat":"57.751813","ne_lng":"15.197281"},
            {"id":"44","long_name":"Djibouti","short_name":"DJ","center_lat":"11.825138","center_lng":"42.590275","sw_lat":"10.931944","sw_lng":"41.759722","ne_lat":"12.713396","ne_lng":"43.416973"},
            {"id":"45","long_name":"Dominica","short_name":"DM","center_lat":"15.414999","center_lng":"-61.370976","sw_lat":"15.207682","sw_lng":"-61.479830","ne_lat":"15.640064","ne_lng":"-61.240303"},
            {"id":"46","long_name":"Timor-Leste","short_name":"TL","center_lat":"-8.874217","center_lng":"125.727539","sw_lat":"-9.504195","sw_lng":"124.041738","ne_lat":"-8.126807","ne_lng":"127.341635"},
            {"id":"47","long_name":"Ecuador","short_name":"EC","center_lat":"-1.831239","center_lng":"-78.183406","sw_lat":"-5.014351","sw_lng":"-92.013048","ne_lat":"1.687211","ne_lng":"-75.188794"},
            {"id":"48","long_name":"Egypt","short_name":"EG","center_lat":"26.820553","center_lng":"30.802498","sw_lat":"22.000000","sw_lng":"24.696775","ne_lat":"31.671535","ne_lng":"36.894545"},
            {"id":"49","long_name":"El Salvador","short_name":"SV","center_lat":"13.794185","center_lng":"-88.896530","sw_lat":"13.155431","sw_lng":"-90.126810","ne_lat":"14.450557","ne_lng":"-87.683752"},
            {"id":"50","long_name":"Eritrea","short_name":"ER","center_lat":"15.179384","center_lng":"39.782334","sw_lat":"12.354723","sw_lng":"36.433348","ne_lat":"18.021210","ne_lng":"43.142977"},
            {"id":"51","long_name":"Estonia","short_name":"EE","center_lat":"58.595272","center_lng":"25.013607","sw_lat":"57.509316","sw_lng":"21.764313","ne_lat":"59.685685","ne_lng":"28.210139"},
            {"id":"52","long_name":"Ethiopia","short_name":"ET","center_lat":"9.145000","center_lng":"40.489673","sw_lat":"3.404136","sw_lng":"32.997734","ne_lat":"14.894215","ne_lng":"48.000000"},
            {"id":"53","long_name":"Fiji","short_name":"FJ","center_lat":"-17.713371","center_lng":"178.065032","sw_lat":"-20.669430","sw_lng":"176.909494","ne_lat":"-12.479535","ne_lng":"-178.230107"},
            {"id":"54","long_name":"Finland","short_name":"FI","center_lat":"61.924110","center_lng":"25.748151","sw_lat":"59.705440","sw_lng":"20.547411","ne_lat":"70.092293","ne_lng":"31.587100"},
            {"id":"55","long_name":"France","short_name":"FR","center_lat":"46.227638","center_lng":"2.213749","sw_lat":"41.342328","sw_lng":"-5.141228","ne_lat":"51.089166","ne_lng":"9.560068"},
            {"id":"56","long_name":"Gabon","short_name":"GA","center_lat":"-0.803689","center_lng":"11.609444","sw_lat":"-3.958372","sw_lng":"8.699053","ne_lat":"2.318109","ne_lng":"14.520556"},
            {"id":"57","long_name":"The Gambia","short_name":"GM","center_lat":"13.443182","center_lng":"-15.310139","sw_lat":"13.065183","sw_lng":"-16.813631","ne_lat":"13.826389","ne_lng":"-13.798611"},
            {"id":"58","long_name":"Georgia","short_name":"GA","center_lat":"32.165622","center_lng":"-82.900075","sw_lat":"30.355591","sw_lng":"-85.605165","ne_lat":"35.000659","ne_lng":"-80.840787"},
            {"id":"59","long_name":"Germany","short_name":"DE","center_lat":"51.165691","center_lng":"10.451526","sw_lat":"47.270112","sw_lng":"5.866342","ne_lat":"55.058347","ne_lng":"15.041896"},
            {"id":"60","long_name":"Ghana","short_name":"GH","center_lat":"7.946527","center_lng":"-1.023194","sw_lat":"4.738874","sw_lng":"-3.260786","ne_lat":"11.166668","ne_lng":"1.199363"},
            {"id":"61","long_name":"Greece","short_name":"GR","center_lat":"39.074208","center_lng":"21.824312","sw_lat":"34.801021","sw_lng":"19.372423","ne_lat":"41.748878","ne_lng":"29.645148"},
            {"id":"62","long_name":"Grenada","short_name":"GD","center_lat":"12.116500","center_lng":"-61.679000","sw_lat":"11.984873","sw_lng":"-61.802728","ne_lat":"12.530183","ne_lng":"-61.377997"},
            {"id":"63","long_name":"Guatemala","short_name":"GT","center_lat":"15.783471","center_lng":"-90.230759","sw_lat":"13.740021","sw_lng":"-92.231836","ne_lat":"17.815697","ne_lng":"-88.225615"},
            {"id":"64","long_name":"Guinea","short_name":"GN","center_lat":"9.945587","center_lng":"-9.696645","sw_lat":"7.190909","sw_lng":"-15.078206","ne_lat":"12.674617","ne_lng":"-7.637853"},
            {"id":"65","long_name":"Guinea-Bissau","short_name":"GW","center_lat":"11.803749","center_lng":"-15.180413","sw_lat":"10.859970","sw_lng":"-16.711736","ne_lat":"12.684723","ne_lng":"-13.627504"},
            {"id":"66","long_name":"Guyana","short_name":"GY","center_lat":"4.860416","center_lng":"-58.930180","sw_lat":"1.164724","sw_lng":"-61.414905","ne_lat":"8.546628","ne_lng":"-56.491120"},
            {"id":"67","long_name":"Haiti","short_name":"HT","center_lat":"18.971187","center_lng":"-72.285215","sw_lat":"18.022078","sw_lng":"-74.480910","ne_lat":"20.089614","ne_lng":"-71.621754"},
            {"id":"68","long_name":"Honduras","short_name":"HN","center_lat":"15.199999","center_lng":"-86.241905","sw_lat":"12.984225","sw_lng":"-89.355148","ne_lat":"17.417104","ne_lng":"-83.127534"},
            {"id":"69","long_name":"Hungary","short_name":"HU","center_lat":"47.162494","center_lng":"19.503304","sw_lat":"45.737089","sw_lng":"16.113387","ne_lat":"48.585234","ne_lng":"22.898122"},
            {"id":"70","long_name":"Iceland","short_name":"IS","center_lat":"64.963051","center_lng":"-19.020835","sw_lat":"63.296102","sw_lng":"-24.546524","ne_lat":"66.566318","ne_lng":"-13.495815"},
            {"id":"71","long_name":"India","short_name":"IN","center_lat":"20.593684","center_lng":"78.962880","sw_lat":"6.753516","sw_lng":"68.162386","ne_lat":"35.504475","ne_lng":"97.395555"},
            {"id":"72","long_name":"Indonesia","short_name":"ID","center_lat":"-0.789275","center_lng":"113.921327","sw_lat":"-11.007436","sw_lng":"95.009707","ne_lat":"6.076912","ne_lng":"141.019562"},
            {"id":"73","long_name":"Iran","short_name":"IR","center_lat":"32.427908","center_lng":"53.688046","sw_lat":"25.059429","sw_lng":"44.031891","ne_lat":"39.781676","ne_lng":"63.333337"},
            {"id":"74","long_name":"Iraq","short_name":"IQ","center_lat":"33.223191","center_lng":"43.679291","sw_lat":"29.061208","sw_lng":"38.793603","ne_lat":"37.380932","ne_lng":"48.575916"},
            {"id":"75","long_name":"Ireland","short_name":"IE","center_lat":"53.412910","center_lng":"-8.243890","sw_lat":"51.421938","sw_lng":"-10.669580","ne_lat":"55.388490","ne_lng":"-5.994700"},
            {"id":"76","long_name":"Israel","short_name":"IL","center_lat":"31.046051","center_lng":"34.851612","sw_lat":"29.479700","sw_lng":"34.267387","ne_lat":"33.332805","ne_lng":"35.896244"},
            {"id":"77","long_name":"Italy","short_name":"IT","center_lat":"41.871940","center_lng":"12.567380","sw_lat":"35.492920","sw_lng":"6.626720","ne_lat":"47.092000","ne_lng":"18.520502"},
            {"id":"78","long_name":"Jamaica","short_name":"JM","center_lat":"18.109581","center_lng":"-77.297508","sw_lat":"17.705724","sw_lng":"-78.368846","ne_lat":"18.525310","ne_lng":"-76.183159"},
            {"id":"79","long_name":"Japan","short_name":"JP","center_lat":"36.204824","center_lng":"138.252924","sw_lat":"24.046045","sw_lng":"122.933830","ne_lat":"45.522772","ne_lng":"153.987430"},
            {"id":"80","long_name":"Jordan","short_name":"JO","center_lat":"30.585164","center_lng":"36.238414","sw_lat":"29.185036","sw_lng":"34.958337","ne_lat":"33.374688","ne_lng":"39.301154"},
            {"id":"81","long_name":"Kazakhstan","short_name":"KZ","center_lat":"48.019573","center_lng":"66.923684","sw_lat":"40.568584","sw_lng":"46.493672","ne_lat":"55.441984","ne_lng":"87.315415"},
            {"id":"82","long_name":"Kenya","short_name":"KE","center_lat":"-0.023559","center_lng":"37.906193","sw_lat":"-4.679682","sw_lng":"33.909821","ne_lat":"5.033421","ne_lng":"41.906832"},
            {"id":"83","long_name":"Kiribati","short_name":"KI","center_lat":"1.870919","center_lng":"-157.362601","sw_lat":"-11.446519","sw_lng":"169.521532","ne_lat":"4.699959","ne_lng":"-150.196032"},
            {"id":"84","long_name":"North Korea","short_name":"KP","center_lat":"40.339852","center_lng":"127.510093","sw_lat":"37.673332","sw_lng":"124.173553","ne_lat":"43.011590","ne_lng":"130.688500"},
            {"id":"85","long_name":"South Korea","short_name":"KR","center_lat":"35.907757","center_lng":"127.766922","sw_lat":"33.106110","sw_lng":"124.608139","ne_lat":"38.616931","ne_lng":"130.923218"},
            {"id":"86","long_name":"Kosovo","short_name":"XK","center_lat":"42.581372","center_lng":"20.889336","sw_lat":"41.857641","sw_lng":"20.014284","ne_lat":"43.268899","ne_lng":"21.789867"},
            {"id":"87","long_name":"Kuwait","short_name":"KW","center_lat":"29.311660","center_lng":"47.481766","sw_lat":"28.524446","sw_lng":"46.553040","ne_lat":"30.103699","ne_lng":"48.430458"},
            {"id":"88","long_name":"Kyrgyzstan","short_name":"KG","center_lat":"41.204380","center_lng":"74.766098","sw_lat":"39.180254","sw_lng":"69.250998","ne_lat":"43.265357","ne_lng":"80.226559"},
            {"id":"89","long_name":"Laos","short_name":"LA","center_lat":"19.856270","center_lng":"102.495496","sw_lat":"13.909720","sw_lng":"100.083214","ne_lat":"22.502872","ne_lng":"107.694830"},
            {"id":"90","long_name":"Latvia","short_name":"LV","center_lat":"56.879635","center_lng":"24.603189","sw_lat":"55.674777","sw_lng":"20.962343","ne_lat":"58.085569","ne_lng":"28.241403"},
            {"id":"91","long_name":"Lebanon","short_name":"LB","center_lat":"33.854721","center_lng":"35.862285","sw_lat":"33.055026","sw_lng":"35.103778","ne_lat":"34.692090","ne_lng":"36.623720"},
            {"id":"92","long_name":"Lesotho","short_name":"LS","center_lat":"-29.609988","center_lng":"28.233608","sw_lat":"-30.675579","sw_lng":"27.011231","ne_lat":"-28.570801","ne_lng":"29.455709"},
            {"id":"93","long_name":"Liberia","short_name":"LR","center_lat":"6.428055","center_lng":"-9.429499","sw_lat":"4.315414","sw_lng":"-11.474248","ne_lat":"8.551986","ne_lng":"-7.369255"},
            {"id":"94","long_name":"Libya","short_name":"LY","center_lat":"26.335100","center_lng":"17.228331","sw_lat":"19.500430","sw_lng":"9.391466","ne_lat":"33.166787","ne_lng":"25.146954"},
            {"id":"95","long_name":"Liechtenstein","short_name":"LI","center_lat":"47.166000","center_lng":"9.555373","sw_lat":"47.048290","sw_lng":"9.471620","ne_lat":"47.270547","ne_lng":"9.635650"},
            {"id":"96","long_name":"Lithuania","short_name":"LT","center_lat":"55.169438","center_lng":"23.881275","sw_lat":"53.896879","sw_lng":"20.954368","ne_lat":"56.450321","ne_lng":"26.835591"},
            {"id":"97","long_name":"Luxembourg","short_name":"LU","center_lat":"49.815273","center_lng":"6.129583","sw_lat":"49.447779","sw_lng":"5.735670","ne_lat":"50.182820","ne_lng":"6.530970"},
            {"id":"98","long_name":"Madagascar","short_name":"MG","center_lat":"-18.766947","center_lng":"46.869107","sw_lat":"-25.606572","sw_lng":"43.185139","ne_lat":"-11.951964","ne_lng":"50.483780"},
            {"id":"99","long_name":"Malawi","short_name":"MW","center_lat":"-13.254308","center_lng":"34.301525","sw_lat":"-17.135278","sw_lng":"32.678889","ne_lat":"-9.367154","ne_lng":"35.924166"},
            {"id":"100","long_name":"Malaysia","short_name":"MY","center_lat":"4.210484","center_lng":"101.975766","sw_lat":"0.853821","sw_lng":"99.640573","ne_lat":"7.363468","ne_lng":"119.269362"},
            {"id":"101","long_name":"Maldives","short_name":"MV","center_lat":"1.977247","center_lng":"73.536103","sw_lat":"-0.703585","sw_lng":"72.638581","ne_lat":"7.106280","ne_lng":"73.759654"},
            {"id":"102","long_name":"Mali","short_name":"ML","center_lat":"17.570692","center_lng":"-3.996166","sw_lat":"10.147811","sw_lng":"-12.238885","ne_lat":"25.000012","ne_lng":"4.266667"},
            {"id":"103","long_name":"Malta","short_name":"MT","center_lat":"35.937496","center_lng":"14.375416","sw_lat":"35.805811","sw_lng":"14.183548","ne_lat":"36.082224","ne_lng":"14.575500"},
            {"id":"104","long_name":"Marshall Islands","short_name":"MH","center_lat":"7.131474","center_lng":"171.184478","sw_lat":"4.572956","sw_lng":"160.797959","ne_lat":"14.673255","ne_lng":"172.170181"},
            {"id":"105","long_name":"Mauritania","short_name":"MR","center_lat":"21.007890","center_lng":"-10.940835","sw_lat":"14.721273","sw_lng":"-17.070134","ne_lat":"27.294445","ne_lng":"-4.833334"},
            {"id":"106","long_name":"Mauritius","short_name":"MU","center_lat":"-20.348404","center_lng":"57.552152","sw_lat":"-20.525512","sw_lng":"56.514367","ne_lat":"-10.336323","ne_lng":"63.503594"},
            {"id":"107","long_name":"Mexico","short_name":"MX","center_lat":"23.634501","center_lng":"-102.552784","sw_lat":"14.534549","sw_lng":"-118.364430","ne_lat":"32.718763","ne_lng":"-86.710571"},
            {"id":"108","long_name":"Micronesia","short_name":"FM","center_lat":"6.887351","center_lng":"158.215072","sw_lat":"3.822442","sw_lng":"138.054982","ne_lat":"10.090378","ne_lng":"163.035591"},
            {"id":"109","long_name":"Moldova","short_name":"MD","center_lat":"47.411631","center_lng":"28.369885","sw_lat":"45.466904","sw_lng":"26.616856","ne_lat":"48.491944","ne_lng":"30.162538"},
            {"id":"110","long_name":"Monaco","short_name":"MC","center_lat":"43.738418","center_lng":"7.424616","sw_lat":"43.724743","sw_lng":"7.409105","ne_lat":"43.751903","ne_lng":"7.439811"},
            {"id":"111","long_name":"Mongolia","short_name":"MN","center_lat":"46.862496","center_lng":"103.846656","sw_lat":"41.581520","sw_lng":"87.737620","ne_lat":"52.148697","ne_lng":"119.931949"},
            {"id":"112","long_name":"Montenegro","short_name":"ME","center_lat":"42.708678","center_lng":"19.374390","sw_lat":"41.849731","sw_lng":"18.433792","ne_lat":"43.558743","ne_lng":"20.357765"},
            {"id":"113","long_name":"Morocco","short_name":"MA","center_lat":"31.791702","center_lng":"-7.092620","sw_lat":"27.666667","sw_lng":"-13.172891","ne_lat":"35.922507","ne_lng":"-0.996976"},
            {"id":"114","long_name":"Mozambique","short_name":"MZ","center_lat":"-18.665695","center_lng":"35.529562","sw_lat":"-26.868109","sw_lng":"30.215550","ne_lat":"-10.471202","ne_lng":"40.839121"},
            {"id":"115","long_name":"Namibia","short_name":"NA","center_lat":"-22.957640","center_lng":"18.490410","sw_lat":"-28.970639","sw_lng":"11.724247","ne_lat":"-16.963486","ne_lng":"25.261752"},
            {"id":"116","long_name":"Nauru","short_name":"NR","center_lat":"-0.522778","center_lng":"166.931503","sw_lat":"-0.554189","sw_lng":"166.909549","ne_lat":"-0.502640","ne_lng":"166.958928"},
            {"id":"117","long_name":"Nepal","short_name":"NP","center_lat":"28.394857","center_lng":"84.124008","sw_lat":"26.347779","sw_lng":"80.052222","ne_lat":"30.446945","ne_lng":"88.199298"},
            {"id":"118","long_name":"The Netherlands","short_name":"NL","center_lat":"52.132633","center_lng":"5.291266","sw_lat":"50.750384","sw_lng":"3.357962","ne_lat":"53.556021","ne_lng":"7.227510"},
            {"id":"119","long_name":"New Zealand","short_name":"NZ","center_lat":"-40.900557","center_lng":"174.885971","sw_lat":"-52.619418","sw_lng":"165.869437","ne_lat":"-29.231342","ne_lng":"-175.831536"},
            {"id":"120","long_name":"Nicaragua","short_name":"NI","center_lat":"12.865416","center_lng":"-85.207229","sw_lat":"10.708055","sw_lng":"-87.691069","ne_lat":"15.030276","ne_lng":"-82.592071"},
            {"id":"121","long_name":"Niger","short_name":"NE","center_lat":"17.607789","center_lng":"8.081666","sw_lat":"11.693756","sw_lng":"0.166667","ne_lat":"23.500000","ne_lng":"15.999034"},
            {"id":"122","long_name":"Nigeria","short_name":"NG","center_lat":"9.081999","center_lng":"8.675277","sw_lat":"4.269857","sw_lng":"2.676932","ne_lat":"13.885645","ne_lng":"14.677981"},
            {"id":"123","long_name":"Norway","short_name":"NO","center_lat":"60.472024","center_lng":"8.468946","sw_lat":"57.959744","sw_lng":"4.500096","ne_lat":"71.185476","ne_lng":"31.168268"},
            {"id":"124","long_name":"Oman","short_name":"OM","center_lat":"21.512583","center_lng":"55.923255","sw_lat":"16.650336","sw_lng":"52.000002","ne_lat":"26.405395","ne_lng":"59.839397"},
            {"id":"125","long_name":"Pakistan","short_name":"PK","center_lat":"30.375321","center_lng":"69.345116","sw_lat":"23.694695","sw_lng":"60.872972","ne_lat":"37.084107","ne_lng":"77.833469"},
            {"id":"126","long_name":"Palau","short_name":"PW","center_lat":"7.514980","center_lng":"134.582520","sw_lat":"2.812743","sw_lng":"131.120110","ne_lat":"8.094023","ne_lng":"134.721099"},
            {"id":"127","long_name":"Panama","short_name":"PA","center_lat":"8.537981","center_lng":"-80.782127","sw_lat":"7.203556","sw_lng":"-83.052241","ne_lat":"9.647779","ne_lng":"-77.158488"},
            {"id":"128","long_name":"Papua New Guinea","short_name":"PG","center_lat":"-6.314993","center_lng":"143.955550","sw_lat":"-11.657861","sw_lng":"140.841970","ne_lat":"-0.871319","ne_lng":"159.492959"},
            {"id":"129","long_name":"Paraguay","short_name":"PY","center_lat":"-23.442503","center_lng":"-58.443832","sw_lat":"-27.588334","sw_lng":"-62.638051","ne_lat":"-19.287707","ne_lng":"-54.258562"},
            {"id":"130","long_name":"Peru","short_name":"PE","center_lat":"-9.189967","center_lng":"-75.015152","sw_lat":"-18.351580","sw_lng":"-81.328504","ne_lat":"-0.038777","ne_lng":"-68.652329"},
            {"id":"131","long_name":"Philippines","short_name":"PH","center_lat":"12.879721","center_lng":"121.774017","sw_lat":"4.613444","sw_lng":"116.931557","ne_lat":"19.574024","ne_lng":"126.604384"},
            {"id":"132","long_name":"Poland","short_name":"PL","center_lat":"51.919438","center_lng":"19.145136","sw_lat":"49.002025","sw_lng":"14.122864","ne_lat":"54.835812","ne_lng":"24.145893"},
            {"id":"133","long_name":"Portugal","short_name":"PT","center_lat":"39.399872","center_lng":"-8.224454","sw_lat":"32.403740","sw_lng":"-31.275330","ne_lat":"42.154205","ne_lng":"-6.190209"},
            {"id":"134","long_name":"Qatar","short_name":"QA","center_lat":"25.354826","center_lng":"51.183884","sw_lat":"24.471118","sw_lng":"50.750055","ne_lat":"26.183093","ne_lng":"51.643260"},
            {"id":"135","long_name":"Romania","short_name":"RO","center_lat":"45.943161","center_lng":"24.966760","sw_lat":"43.618619","sw_lng":"20.261759","ne_lat":"48.265274","ne_lng":"29.757101"},
            {"id":"136","long_name":"Russia","short_name":"RU","center_lat":"61.524010","center_lng":"105.318756","sw_lat":"41.185353","sw_lng":"19.640535","ne_lat":"81.858122","ne_lng":"-169.046727"},
            {"id":"137","long_name":"Rwanda","short_name":"RW","center_lat":"-1.940278","center_lng":"29.873888","sw_lat":"-2.839840","sw_lng":"28.861755","ne_lat":"-1.047572","ne_lng":"30.899401"},
            {"id":"138","long_name":"Samoa","short_name":"WS","center_lat":"-13.759029","center_lng":"-172.104629","sw_lat":"-14.076588","sw_lng":"-172.803676","ne_lat":"-13.440033","ne_lng":"-171.405859"},
            {"id":"139","long_name":"San Marino","short_name":"SM","center_lat":"43.942360","center_lng":"12.457777","sw_lat":"43.893681","sw_lng":"12.403482","ne_lat":"43.992075","ne_lng":"12.516704"},
            {"id":"140","long_name":"Saudi Arabia","short_name":"SA","center_lat":"23.885942","center_lng":"45.079162","sw_lat":"16.379528","sw_lng":"34.548998","ne_lat":"32.154284","ne_lng":"55.666700"},
            {"id":"141","long_name":"Senegal","short_name":"SN","center_lat":"14.497401","center_lng":"-14.452362","sw_lat":"12.307289","sw_lng":"-17.529848","ne_lat":"16.693054","ne_lng":"-11.348607"},
            {"id":"142","long_name":"Serbia","short_name":"RS","center_lat":"44.016521","center_lng":"21.005859","sw_lat":"42.231503","sw_lng":"18.838522","ne_lat":"46.190032","ne_lng":"23.006310"},
            {"id":"143","long_name":"Seychelles","short_name":"SC","center_lat":"-4.679574","center_lng":"55.491977","sw_lat":"-10.227033","sw_lng":"46.197785","ne_lat":"-4.209786","ne_lng":"56.294294"},
            {"id":"144","long_name":"Sierra Leone","short_name":"SL","center_lat":"8.460555","center_lng":"-11.779889","sw_lat":"6.899025","sw_lng":"-13.302007","ne_lat":"9.999972","ne_lng":"-10.271651"},
            {"id":"145","long_name":"Singapore","short_name":"SG","center_lat":"1.352083","center_lng":"103.819836","sw_lat":"1.166398","sw_lng":"103.605575","ne_lat":"1.470772","ne_lng":"104.085557"},
            {"id":"146","long_name":"Slovakia","short_name":"SK","center_lat":"48.669026","center_lng":"19.699024","sw_lat":"47.731159","sw_lng":"16.833182","ne_lat":"49.613805","ne_lng":"22.558934"},
            {"id":"147","long_name":"Slovenia","short_name":"SI","center_lat":"46.151241","center_lng":"14.995463","sw_lat":"45.421674","sw_lng":"13.375336","ne_lat":"46.876659","ne_lng":"16.596686"},
            {"id":"148","long_name":"Solomon Islands","short_name":"SB","center_lat":"-9.645710","center_lng":"160.156194","sw_lat":"-11.863458","sw_lng":"155.486241","ne_lat":"-6.589240","ne_lng":"167.283081"},
            {"id":"149","long_name":"Somalia","short_name":"SO","center_lat":"5.152149","center_lng":"46.199616","sw_lat":"-1.662041","sw_lng":"40.994373","ne_lat":"11.988614","ne_lng":"51.413029"},
            {"id":"150","long_name":"South Africa","short_name":"ZA","center_lat":"-30.559482","center_lng":"22.937506","sw_lat":"-34.833138","sw_lng":"16.454436","ne_lat":"-22.125387","ne_lng":"32.890991"},
            {"id":"151","long_name":"South Sudan","short_name":"SS","center_lat":"7.963092","center_lng":"30.158930","sw_lat":"3.488980","sw_lng":"23.440849","ne_lat":"12.236389","ne_lng":"35.948997"},
            {"id":"152","long_name":"Spain","short_name":"ES","center_lat":"40.463667","center_lng":"-3.749220","sw_lat":"27.637789","sw_lng":"-18.160788","ne_lat":"43.792380","ne_lng":"4.327784"},
            {"id":"153","long_name":"Sri Lanka","short_name":"LK","center_lat":"7.873054","center_lng":"80.771797","sw_lat":"5.919078","sw_lng":"79.521983","ne_lat":"9.836001","ne_lng":"81.878703"},
            {"id":"154","long_name":"Saint Lucia","short_name":"LC","center_lat":"13.909444","center_lng":"-60.978893","sw_lat":"13.708118","sw_lng":"-61.079672","ne_lat":"14.110932","ne_lng":"-60.873098"},
            {"id":"155","long_name":"Sudan","short_name":"SD","center_lat":"12.862807","center_lng":"30.217636","sw_lat":"9.347221","sw_lng":"21.814939","ne_lat":"22.224918","ne_lng":"38.584219"},
            {"id":"156","long_name":"Suriname","short_name":"SR","center_lat":"3.919305","center_lng":"-56.027783","sw_lat":"1.837306","sw_lng":"-58.070506","ne_lat":"6.009283","ne_lng":"-53.951024"},
            {"id":"157","long_name":"Swaziland","short_name":"SZ","center_lat":"-26.522503","center_lng":"31.465866","sw_lat":"-27.317363","sw_lng":"30.791094","ne_lat":"-25.718520","ne_lng":"32.134844"},
            {"id":"158","long_name":"Sweden","short_name":"SE","center_lat":"60.128161","center_lng":"18.643501","sw_lat":"55.328720","sw_lng":"10.963187","ne_lat":"69.059971","ne_lng":"24.166809"},
            {"id":"159","long_name":"Switzerland","short_name":"CH","center_lat":"46.818188","center_lng":"8.227512","sw_lat":"45.817920","sw_lng":"5.956080","ne_lat":"47.808455","ne_lng":"10.492340"},
            {"id":"160","long_name":"Syria","short_name":"SY","center_lat":"34.802075","center_lng":"38.996815","sw_lat":"32.311136","sw_lng":"35.716596","ne_lat":"37.320569","ne_lng":"42.376309"},
            {"id":"161","long_name":"Taiwan","short_name":"TW","center_lat":"23.697810","center_lng":"120.960515","sw_lat":"20.563791","sw_lng":"116.711860","ne_lat":"26.387353","ne_lng":"122.006905"},
            {"id":"162","long_name":"Tajikistan","short_name":"TJ","center_lat":"38.861034","center_lng":"71.276093","sw_lat":"36.671990","sw_lng":"67.342012","ne_lat":"41.044367","ne_lng":"75.153956"},
            {"id":"163","long_name":"Tanzania","short_name":"TZ","center_lat":"-6.369028","center_lng":"34.888822","sw_lat":"-11.761254","sw_lng":"29.340000","ne_lat":"-0.984397","ne_lng":"40.444965"},
            {"id":"164","long_name":"Thailand","short_name":"TH","center_lat":"15.870032","center_lng":"100.992541","sw_lat":"5.612729","sw_lng":"97.343396","ne_lat":"20.465143","ne_lng":"105.636812"},
            {"id":"165","long_name":"Togo","short_name":"TG","center_lat":"8.619543","center_lng":"0.824782","sw_lat":"6.112358","sw_lng":"-0.144042","ne_lat":"11.139496","ne_lng":"1.809050"},
            {"id":"166","long_name":"Tonga","short_name":"TO","center_lat":"-21.178986","center_lng":"-175.198242","sw_lat":"-21.473461","sw_lng":"-175.679616","ne_lat":"-15.566393","ne_lng":"-173.702484"},
            {"id":"167","long_name":"Tunisia","short_name":"TN","center_lat":"33.886917","center_lng":"9.537499","sw_lat":"30.228034","sw_lng":"7.522313","ne_lat":"37.358287","ne_lng":"11.599217"},
            {"id":"168","long_name":"Turkey","short_name":"TR","center_lat":"38.963745","center_lng":"35.243322","sw_lat":"35.807680","sw_lng":"25.663637","ne_lat":"42.106239","ne_lng":"44.818128"},
            {"id":"169","long_name":"Turkmenistan","short_name":"TM","center_lat":"38.969719","center_lng":"59.556278","sw_lat":"35.128760","sw_lng":"52.447845","ne_lat":"42.798844","ne_lng":"66.707353"},
            {"id":"170","long_name":"Tuvalu","short_name":"TV","center_lat":"-7.478442","center_lng":"178.679921","sw_lat":"-10.791659","sw_lng":"176.058891","ne_lat":"-5.642230","ne_lng":"179.872261"},
            {"id":"171","long_name":"Uganda","short_name":"UG","center_lat":"1.373333","center_lng":"32.290275","sw_lat":"-1.481542","sw_lng":"29.573433","ne_lat":"4.223001","ne_lng":"35.033049"},
            {"id":"172","long_name":"Ukraine","short_name":"UA","center_lat":"48.379433","center_lng":"31.165580","sw_lat":"44.386463","sw_lng":"22.137159","ne_lat":"52.379581","ne_lng":"40.228581"},
            {"id":"173","long_name":"United Kingdom","short_name":"GB","center_lat":"55.378051","center_lng":"-3.435973","sw_lat":"49.562515","sw_lng":"-12.649357","ne_lat":"59.860670","ne_lng":"3.976555"},
            {"id":"174","long_name":"United States","short_name":"US","center_lat":"39.500240","center_lng":"-98.350891","sw_lat":"25.820898","sw_lng":"-124.712891","ne_lat":"49.380240","ne_lng":"-66.940662"},
            {"id":"175","long_name":"Uruguay","short_name":"UY","center_lat":"-32.522779","center_lng":"-55.765835","sw_lat":"-35.031419","sw_lng":"-58.439150","ne_lat":"-30.085215","ne_lng":"-53.184292"},
            {"id":"176","long_name":"Uzbekistan","short_name":"UZ","center_lat":"41.377491","center_lng":"64.585262","sw_lat":"37.172257","sw_lng":"55.998218","ne_lat":"45.590075","ne_lng":"73.148946"},
            {"id":"177","long_name":"Vanuatu","short_name":"VU","center_lat":"-15.376706","center_lng":"166.959158","sw_lat":"-20.252293","sw_lng":"166.541759","ne_lat":"-13.072455","ne_lng":"170.238460"},
            {"id":"178","long_name":"Vatican City","short_name":"VA","center_lat":"41.902916","center_lng":"12.453389","sw_lat":"41.900198","sw_lng":"12.445687","ne_lat":"41.907561","ne_lng":"12.458480"},
            {"id":"179","long_name":"Venezuela","short_name":"VE","center_lat":"6.423750","center_lng":"-66.589730","sw_lat":"0.647529","sw_lng":"-73.351558","ne_lat":"12.486694","ne_lng":"-59.805666"},
            {"id":"180","long_name":"Vietnam","short_name":"VN","center_lat":"14.058324","center_lng":"108.277199","sw_lat":"8.412730","sw_lng":"102.144410","ne_lat":"23.393395","ne_lng":"109.468975"},
            {"id":"181","long_name":"Yemen","short_name":"YE","center_lat":"15.552727","center_lng":"48.516388","sw_lat":"12.108166","sw_lng":"41.816055","ne_lat":"18.999633","ne_lng":"54.533555"},
            {"id":"182","long_name":"Zambia","short_name":"ZM","center_lat":"-13.133897","center_lng":"27.849332","sw_lat":"-18.077418","sw_lng":"21.996388","ne_lat":"-8.203284","ne_lng":"33.702222"},
            {"id":"183","long_name":"Zimbabwe","short_name":"ZW","center_lat":"-19.015438","center_lng":"29.154857","sw_lat":"-22.424523","sw_lng":"25.237368","ne_lat":"-15.609319","ne_lng":"33.068236"}
        ];


    function initMap() {
        var place = { lat:  48.181108, lng: 11.511545 };
        var map = new google.maps.Map(
                $( '.map')[0],
                {
                    zoom: 10,
                    center: place,
                    styles :

                        [
                            {
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#616161"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.stroke",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative.land_parcel",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#bdbdbd"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#eeeeee"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#757575"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e5e5e5"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#757575"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#dadada"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#616161"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit.line",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e5e5e5"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit.station",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#eeeeee"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#c9c9c9"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            }
                        ]
                }
            );

        var markerImage = location.protocol + '//' + location.hostname + '/wp-content/themes/UDFT/img/marker-img.png';
        console.log(location.protocol + '//' + location.hostname + '/wp-content/themes/UDFT/img/marker-img.png');
        var marker = new google.maps.Marker( { position: place, map : map, icon: markerImage } );


        marker.addListener('click', function() {
            //infowindow.open(map, marker);
            if ( !$('body').hasClass('has-map-info-box') ) {
                if ( !$('.map-info-box').parent().hasClass('map') ) {
                    $('.map-info-box').detach().prependTo('.map');
                }

                $('body').addClass('has-map-info-box');
            }
            else {
                $('body').removeClass('has-map-info-box');
            }
        });


        /*var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': 'Ehrenbreitsteiner Str. 20, 80993 München' }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                map.fitBounds(results[0].geometry.viewport);
            }
        });*/

        /*var index_country = 40;
        var myOptions = {
            center: new google.maps.LatLng(
                countries[index_country].center_lat,
                countries[index_country].center_lng),
        }
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        // set the bounds of the map
        var bounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(countries[index_country].sw_lat, countries[index_country].sw_lng),
            new google.maps.LatLng(countries[index_country].ne_lat, countries[index_country].ne_lng) );

        map.fitBounds(bounds);*/

    }

    /*if ( $('.map').length > 0 ) {
        I = setInterval(function () {
            if ((typeof google === 'object' && typeof google.maps === 'object')) {
                initMap();
                clearInterval(I);
            }
        }, 100);
    }*/



    /*if ( !$('body').hasClass( 'wp-admin' ) ) {
        $("body").queryLoader2({
            barColor: '#000',
            backgroundColor: '#fff',
            percentage: true,
            barHeight: 2,
            completeAnimation: "grow",
            minimumTime: 100,
            onLoadComplete: hidePreLoader
        });

        function hidePreLoader() {
            $("#preloader").hide();
        }
    }*/

    $('.menu-manage').on( 'click', function( e ) {
        var trg;
        if ( !$(e.target).hasClass('menu-manage') )
            trg = $(e.target).parent();
        else
            trg = $(e.target);

        if ( !$('body').hasClass('top-menu-opened') ) {
            $('body').addClass('top-menu-opened');
        }
        else {
            $('body').removeClass('top-menu-opened');
        }
    });


    $('.close-nav').on( 'click', function( e ) {
        $('body').removeClass('top-menu-opened');
    });


    $('.modal-close, a.fm-btn').on( 'click', function( e ) {
        $('body').removeClass('loading').removeClass('has-modal').removeClass('has-popup');
    });



    /*$('.partner-imgs').slick( {
        'slidesToShow' : 3,
        'slidesToScroll' : 1,
        'responsive' : [
            {
                breakpoint: 768,
                settings: {
                    'slidesToShow': 2,
                    'autoplay': true,
                    'infinite': true,
                }
            },
            {
                breakpoint : 480,
                settings : {
                    'slidesToShow' : 1,
                    'autoplay' : true,
                    'infinite' : true,
                }
            }
        ]
    } );*/




    /*if ( $('.parallaxParent').length > 0 ) {

        var parallaxController = new ScrollMagic.Controller( { globalSceneOptions: { triggerHook: "onEnter", duration: "150%" } } );

        new ScrollMagic.Scene({triggerElement: '.parallaxParent'})
            .setTween('.parallaxParent > .parallaxChild', { y: '100%', ease: Linear.easeNone } )
            .addTo(parallaxController);

    }*/



    /*let scroller = { 'settedClass' : false, 'wh' : 300 }

    $(document).mousewheel(function (e) {

        if (e.deltaY == -1) {
            if ( $(window).scrollTop() > 150 ) {
                if (!$('body').hasClass('top-menu-opened')) {
                    $('.header-top-container').addClass('hided-on-top');
                }
                if (!scroller.settedClass && ($(window).scrollTop() > scroller.wh)) {
                    $('.header-top-container').addClass('small-top-img engaged');
                    scroller.settedClass = true;
                }
            }
        }
        else {
            $('.header-top-container').removeClass('hided-on-top');
            if ( scroller.settedClass && ( $(window).scrollTop() < scroller.wh ) ) {
                $('.header-top-container').removeClass('small-top-img engaged');
                scroller.settedClass = false;
            }
        }

    });

    $(window).on( 'resize', function( e ) {
        scroller.wh = $(window).height();
    } );*/




    function custom_validate( form, rules ) {

        var methods = {

            'checkPhone' : function (el) {

                var val = $(el).val().replace(/-|\(|\)|\+|\s/g, '');
                if (val.length > 10)
                    return true;
                else
                    return false;

            }

        }

        var args = {
                'f-name': [
                    {'regexp': /.{1,50}/, 'error': 'Das Feld "Name" muss ausgefullt sein'},
                    {'regexp': /^\w{1}/i, 'error': 'Das Feld "Name" muss ein Wort enthalten'}
                ],
                's-name': [
                    {'regexp': /.{1,50}/, 'error': 'Das Feld "Nachname" muss ausgefullt sein'},
                    {'regexp': /^\w{1}/i, 'error': 'Das Feld "Nachname" muss ein Wort enthalten'}
                ],
                'phone': [
                    {'regexp': /.{1,50}/, 'error': 'Das Feld "Telefon" muss ausgefullt sein'},
                    {
                        'regexp': /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im,
                        'error': 'Das Feld "Telefon" muss eine gultige Telefonnummer sein, zum Beispiel - +0729777555'
                    }
                ],
                'adress': [
                    {'regexp': /.{1,500}/, 'error': 'Das Feld "Adresse" muss ausgefullt sein'},
                ],
                'email': [
                    {'regexp': /.{1,50}/, 'error': 'Das Feld "Email" muss ausgefullt sein'},
                    { 'regexp': /^.\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/im, 'error': 'Das Feld "Email" muss eine gultige Postanschrift enthalten, z. B. test@gmail.' }
                ],
            },
            result, errors = [];

        if ( rules )
            args = rules;


        $(form).find('input, textarea, select').each(function (i, el) {

            Object.keys(args).map(function (key, index) {
                var mode = 'any-case';
                if (key == $(el).attr('name')) {
                    var check = args[key], result;
                    $.each(check, function (i, method) {
                        if (method['mode']) {
                            mode = method['mode'];
                        }
                        if ( mode == 'any-case' || ( mode == 'if-filled'  && $(el).val().length > 0) ) {
                            if (method['function']) {
                                if ( typeof window[method['function']] == 'function' && !window[method['function']](el) ) {
                                    $(el).parents('.f-input-box').addClass('has-error');
                                    $(el).parents('.f-input-box').find('.f-error').html(method['error']);
                                    errors.push(method['error']);
                                    return false
                                }
                            }
                            else if (method['regexp']) {
                                if (!$(el).val().match(method['regexp'])) {
                                    $(el).parents('.f-input-box').addClass('has-error');
                                    $(el).parents('.f-input-box').find('.f-error').html(method['error']);
                                    errors.push(method['error']);
                                    return false;
                                }
                            }
                        }
                    });
                }
            });

        });

        if (errors.length == 0) return true;
        else return errors;

    }



    $('.contact-form').on( 'submit', function( e ) {

        e.preventDefault();

        $(e.target).find('input, textarea').each( function( i, el ) {
            $(el).parents('.f-input-box').removeClass('has-error');
            $(el).parents('.f-input-box').find('.f-error').empty();
        });
        $('.fm-text').empty();

        var rules = {

            'f-firstname': [
                { 'mode' : 'any-case', 'regexp': /\w{1}/, 'error': 'Das Feld "Vorname" muss ein Wort sein' }
            ],
            'f-lastname': [
                { 'mode' : 'if-filled', 'regexp': /\w{1}/, 'error': 'Field "Unternehmen" must be a word' }
            ],
            'f-email': [
                { 'mode' : 'any-case', 'regexp': /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, 'error': 'Das Feld "E-Mail" muss eine gültige E-Mail sein' }
            ],
            'f-phone': [
                { 'mode' : 'any-case', 'regexp': /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g, 'error': 'Das Feld "Telefon" muss eine gültige Telefonnummer sein' }
            ],
            'f-plz': [
                { 'mode' : 'if-filled', 'regexp': /[0-9]{5,7}/, 'error': 'Das "PLZ" - Feld muss die richtige Postleitzahl enthalten' }
            ],
            'f-ort': [
                { 'mode' : 'if-filled', 'regexp': /.{3,50}/, 'error': 'Feld "Ort" muss ein Satz sein' }
            ],
            'f-description': [
                { 'mode' : 'any-case', 'regexp': /.{5,1000}/, 'error': 'Das "Beschreibungsfeld" ist falsch und enthält mindestens 20 Zeichen' }
            ],
            'terms' : [
                { 'mode' : 'any-case', 'function' : 'check_checkbox', 'error' : 'Bedingungen müssen genehmigt werden' }
            ]

        }

        var errors = custom_validate( e.target, rules);

        console.log(errors);
        if ( errors && !Array.isArray( errors ) ) {

            $('body').addClass('has-modal loading');

            var formData = new FormData();
            var params = $(e.target).serializeArray();
            $.each(params, function (i, val) {
                formData.append(val.name, val.value);
            });
            formData.append('action', 'get_form_request');

            $.ajax({
                'method': 'POST',
                'url': ajaxdata.url,
                'data': formData,
                'processData': false,
                'contentType': false,
                'success': function (answer) {
                    var result = JSON.parse(answer);
                    $('body').removeClass('loading');
                    $('.modal-content .fm-text').html( result.content );
                },
                'error': function () {
                    $('body').removeClass('loading');
                }
            });
        }



    });


    $('.contact-form input, .lead-form input, .contact-form textarea, .lead-form textarea').on( 'click', function( e ) {
        console.log(e.target);
        $(e.target).parents('.f-input-box').removeClass('has-error');
        $(e.target).parents('.f-input-box').find('.f-error').empty();
    });



    $('.lead-form-trigger').on( 'click', function( e ) {
        $('body').addClass('has-modal has-popup');
        $('.fm-text').empty();
    });



    $('.lead-form').on( 'submit', function( e ) {

        e.preventDefault();

        $(e.target).find('input, textarea').each( function( i, el ) {
            $(el).parents('.f-input-box').removeClass('has-error');
            $(el).parents('.f-input-box').find('.f-error').empty();
        });
        $('.fm-text').empty();

        var rules = {

            'f-name': [
                { 'mode' : 'any-case', 'regexp': /\w{1,}/, 'error': 'Das Feld "Name" muss ein Wort sein' }
            ],
            'f-email': [
                { 'mode' : 'any-case', 'regexp': /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, 'error': 'Das Feld "E-Mail" muss eine gültige E-Mail sein' }
            ],
            'f-description': [
                { 'mode' : 'any-case', 'regexp': /.{5,1000}/, 'error': 'Das "Beschreibungsfeld" ist falsch und enthält mindestens 20 Zeichen' }
            ]

        }

        var errors = custom_validate( e.target, rules);

        console.log(errors);
        if ( errors && !Array.isArray( errors ) ) {

            $('body').addClass('has-modal loading');

            var formData = new FormData();
            var params = $(e.target).serializeArray();
            $.each(params, function (i, val) {
                formData.append(val.name, val.value);
            });
            formData.append('action', 'get_form_request');

            $.ajax({
                'method': 'POST',
                'url': ajaxdata.url,
                'data': formData,
                'processData': false,
                'contentType': false,
                'success': function (answer) {
                    var result = JSON.parse(answer);
                    $('body').removeClass('loading');
                    $('.modal-content .fm-text').html( result.content );
                },
                'error': function () {
                    $('body').removeClass('loading');
                }
            });
        }



    });


    /*if ( $('.gft-slides-container').length > 0 ) {

        $('.gft-slides-container').slick({
            arrows: true,
        });

        $('.slick-arrow').on('click', function (e) {
            $('.slick-arrow').removeClass('active');
            $(e.target).addClass('active');
        });

        $('.slick-arrow:last-child').addClass('active');

    }*/


    let sidebar1;
    setTimeout( function() {

        if ( $('.single-post-container').length > 0 && $(window).width() > 992 ) {
                sidebar1 = new StickySidebar('.single-post-sidebar', {
                containerSelector: '.single-post-content-container',
                innerWrapperSelector: '.related-posts',
                topSpacing: 20,
                bottomSpacing: 20,
                    disableAt: 992
            });

        }

    }, 500 );


    $(window).on( 'resize', function() {
        if ( typeof sidebar1 != 'undefined' ) {
            if ($(window).width() < 992) {
                sidebar1.destroy();
            } else {
                if (sidebar1.options) {
                    sidebar1.updateSticky();
                }
            }
        }
    });


    $('.to-top-button').on( 'click', function( e ) {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });


    $(window).on( 'scroll', function( e ) {
        if ( $(window).scrollTop() > $(window).height() * 0.5 ) {
            $('.to-top-button').addClass('visible-button');
        }
        else {
            $('.to-top-button').removeClass('visible-button');
        }
    });


    $('.gft-tab-nav-item').on( 'click', function( e ) {
        var trg = $(e.target).hasClass('gft-tab-nav-item') ? $(e.target) : $(e.target).parents('.gft-tab-nav-item');
        $('.gft-tab-nav-item').removeClass('active');
        $(trg).addClass('active');
        $('.gft-tab-content-item.active').fadeOut();
        $('.gft-tab-content-item').each( function( i, el ) {
            $(el).removeClass('active');
            if ( $(el).attr('data-n') == $(trg).attr('data-n') ) {
                console.log( $(trg).attr('data-n') + ' - ' + $(el).attr('data-n') );
                $('.gft-tab-contents').css( { 'height' : $(el).height() + 'px' } )
                $(el).fadeIn().addClass('active');
            }
        } );
    } );

    $('.gft-tab-nav-item:first-child').trigger('click');


    var $headerHeight = $('.header-top-container').height();
    $('.header').css( { 'padding-top' : $headerHeight + 'px' } );
    $(window).on( 'scroll', function( e ) {
        if ( $(window).scrollTop() > $headerHeight * 2 ) {
            if ( !$('.header-top-container').hasClass('fixed-header') ) {
                $('.header-top-container').addClass('fixed-header').css( { 'top' : '-' + $headerHeight + 'px', 'position' : 'fixed' } ).animate( { 'top' : 0 }, 400 );
            }
        }
        else {
            $('.header-top-container').removeClass('fixed-header');
            if ( $(window).scrollTop() == 0 ) {
                $('.header-top-container').removeClass('fixed-header').css( { 'top' : 0, 'position' : 'absolute' } )
            }
        }
    } );

    $(window).on( 'resize', function( e ) {
        $headerHeight = $('.header-top-container').height();
        $('.header').css( { 'padding-top' : $headerHeight + 'px' } );
    });


    /*$('.top-nav .top-menu > li.menu-item.menu-item-has-children').on( 'mouseover', function( e ) {
        let $cl = $(e.target).attr('class');
        //console.log( $cl == undefined );
        if ( $cl == undefined ) {
            $(e.target).parent().addClass( 'hovered' );
        }
    });*/

    /*$('.top-nav .top-menu > li.menu-item,menu-item-has-children').on( 'mouseout', function( e ) {
        let $cl = $(e.target).attr('class');
        if ( $cl == undefined ) {
            $(e.target).parent().removeClass( 'hovered' );
        }
    });*/

    $('.top-nav .top-menu > li.menu-item.menu-item-has-children').hover(
        function( e ) {
            $(e.currentTarget).addClass('opened');
        },
        function ( e ) {
            $(e.currentTarget).removeClass('opened');
        }
    );

    $('.menu-service-cat-pointer').on( 'click', function( e ) {
        $(e.target).parents('li.menu-item').toggleClass('opened');
    });


    /*if ( typeof Modernizr != 'undefined' ) {
        Modernizr.on( 'webp', function ( result ) {
            if ( result ) {
                let re = /(.jpg|.png)/;
                $('.has-bg, .gft-list-box').each( function (i, el) {
                    let bg = $(el).css('background-image');
                    if (bg != 'none') {
                        $(el).css({'background': bg.replace(re, '$1.webp')})
                    }
                });
            } else {
                // not-supported
            }
        });
    }*/


});
