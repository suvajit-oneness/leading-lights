<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('sortname');
            $table->string('name');
            $table->string('phonecode');
            $table->timestamps();
        });
        $data = [
            ['sortname' => 'AF', 'name' => 'Afghanistan', 'phonecode' => '93'],
            ['sortname' => 'AL', 'name' => 'Albania', 'phonecode' => '355'],
            ['sortname' => 'DZ', 'name' => 'Algeria', 'phonecode' => '213'],
            ['sortname' => 'AS', 'name' => 'American Samoa', 'phonecode' => '1684'],
            ['sortname' => 'AD', 'name' => 'Andorra', 'phonecode' => '376'],
            ['sortname' => 'AO', 'name' => 'Angola', 'phonecode' => '244'],
            ['sortname' => 'AI', 'name' => 'Anguilla', 'phonecode' => '1264'],
            // ['sortname' => 'AQ', 'name' => 'Antarctica', 'phonecode' => '0'],
            ['sortname' => 'AG', 'name' => 'Antigua And Barbuda', 'phonecode' => '1268'],
            ['sortname' => 'AR', 'name' => 'Argentina', 'phonecode' => '54'],
            ['sortname' => 'AM', 'name' => 'Armenia', 'phonecode' => '374'],
            ['sortname' => 'AW', 'name' => 'Aruba', 'phonecode' => '297'],
            ['sortname' => 'AU', 'name' => 'Australia', 'phonecode' => '61'],
            ['sortname' => 'AT', 'name' => 'Austria', 'phonecode' => '43'],
            ['sortname' => 'AZ', 'name' => 'Azerbaijan', 'phonecode' => '994'],
            ['sortname' => 'BS', 'name' => 'Bahamas The', 'phonecode' => '1242'],
            ['sortname' => 'BH', 'name' => 'Bahrain', 'phonecode' => '973'],
            ['sortname' => 'BD', 'name' => 'Bangladesh', 'phonecode' => '880'],
            ['sortname' => 'BB', 'name' => 'Barbados', 'phonecode' => '1246'],
            ['sortname' => 'BY', 'name' => 'Belarus', 'phonecode' => '375'],
            ['sortname' => 'BE', 'name' => 'Belgium', 'phonecode' => '32'],
            ['sortname' => 'BZ', 'name' => 'Belize', 'phonecode' => '501'],
            ['sortname' => 'BJ', 'name' => 'Benin', 'phonecode' => '229'],
            ['sortname' => 'BM', 'name' => 'Bermuda', 'phonecode' => '1441'],
            ['sortname' => 'BT', 'name' => 'Bhutan', 'phonecode' => '975'],
            ['sortname' => 'BO', 'name' => 'Bolivia', 'phonecode' => '591'],
            // ['sortname' => 'BA', 'name' => 'Bosnia and Herzegovina', 'phonecode'=>'387'],
            ['sortname' => 'BW', 'name' => 'Botswana', 'phonecode' => '267'],
            // ['sortname' => 'BV', 'name' => 'Bouvet Island', 'phonecode' => '0'],
            ['sortname' => 'BR', 'name' => 'Brazil', 'phonecode' => '55'],
            ['sortname' => 'IO', 'name' => 'British Indian Ocean Territory', 'phonecode' => '246'],
            ['sortname' => 'BN', 'name' => 'Brunei', 'phonecode' => '673'],
            ['sortname' => 'BG', 'name' => 'Bulgaria', 'phonecode' => '359'],
            ['sortname' => 'BF', 'name' => 'Burkina Faso', 'phonecode' => '226'],
            ['sortname' => 'BI', 'name' => 'Burundi', 'phonecode' => '257'],
            ['sortname' => 'KH', 'name' => 'Cambodia', 'phonecode' => '855'],
            ['sortname' => 'CM', 'name' => 'Cameroon', 'phonecode'  => '237'],
            // ['sortname' => 'CA', 'name' => 'Canada', 'phonecode' => '1'],
            ['sortname' => 'CV', 'name' => 'Cape Verde', 'phonecode' => '238'],
            ['sortname' => 'KY', 'name' => 'Cayman Islands', 'phonecode' => '1345'],
            ['sortname' => 'CF', 'name' => 'Central African Republic', 'phonecode' => '236'],
            ['sortname' => 'TD', 'name' => 'Chad', 'phonecode' => '235'],
            ['sortname' => 'CL', 'name' => 'Chile', 'phonecode' => '56'],
            ['sortname' => 'CN', 'name' => 'China', 'phonecode' => '86'],
            ['sortname' => 'CX', 'name' => 'Christmas Island', 'phonecode' => '61'],
            ['sortname' => 'CC', 'name' => 'Cocos (Keeling] Islands', 'phonecode' => '672'],
            ['sortname' => 'CO', 'name' => 'Colombia', 'phonecode' => '57'],
            ['sortname' => 'KM', 'name' => 'Comoros', 'phonecode' => '269'],
            ['sortname' => 'CG', 'name' => 'Republic Of The Congo', 'phonecode' => '242'],
            ['sortname' => 'CD', 'name' => 'Democratic Republic Of The Congo', 'phonecode' => '242'],
            ['sortname' => 'CK', 'name' => 'Cook Islands', 'phonecode' => '682'],
            ['sortname' => 'CR', 'name' => 'Costa Rica', 'phonecode' => '506'],
            ['sortname' => 'CI', 'name' => 'Cote D\'Ivoire (Ivory Coast]', 'phonecode' => '225'],
            ['sortname' => 'HR', 'name' => 'Croatia (Hrvatska]', 'phonecode' => '385'],
            ['sortname' => 'CU', 'name' => 'Cuba', 'phonecode' => '53'],
            ['sortname' => 'CY', 'name' => 'Cyprus', 'phonecode' => '357'],
            ['sortname' => 'CZ', 'name' => 'Czech Republic', 'phonecode' => '420'],
            ['sortname' => 'DK', 'name' => 'Denmark', 'phonecode' => '45'],
            ['sortname' => 'DJ', 'name' => 'Djibouti', 'phonecode' => '253'],
            ['sortname' => 'DM', 'name' => 'Dominica', 'phonecode' => '1767'],
            ['sortname' => 'DO', 'name' => 'Dominican Republic', 'phonecode' => '1809'],
            ['sortname' => 'TP', 'name' => 'East Timor', 'phonecode' => '670'],
            ['sortname' => 'EC', 'name' => 'Ecuador', 'phonecode' => '593'],
            ['sortname' => 'EG', 'name' => 'Egypt', 'phonecode' => '20'],
            ['sortname' => 'SV', 'name' => 'El Salvador', 'phonecode' => '503'],
            ['sortname' => 'GQ', 'name' => 'Equatorial Guinea', 'phonecode' => '240'],
            ['sortname' => 'ER', 'name' => 'Eritrea', 'phonecode' => '291'],
            ['sortname' => 'EE', 'name' => 'Estonia', 'phonecode' => '372'],
            ['sortname' => 'ET', 'name' => 'Ethiopia', 'phonecode' => '251'],
            ['sortname' => 'XA', 'name' => 'External Territories of Australia', 'phonecode' => '61'],
            ['sortname' => 'FK', 'name' => 'Falkland Islands', 'phonecode' => '500'],
            ['sortname' => 'FO', 'name' => 'Faroe Islands', 'phonecode' => '298'],
            ['sortname' => 'FJ', 'name' => 'Fiji Islands', 'phonecode' => '679'],
            ['sortname' => 'FI', 'name' => 'Finland', 'phonecode' => '358'],
            ['sortname' => 'FR', 'name' => 'France', 'phonecode' => '33'],
            ['sortname' => 'GF', 'name' => 'French Guiana', 'phonecode' => '594'],
            ['sortname' => 'PF', 'name' => 'French Polynesia', 'phonecode' => '689'],
            // ['sortname' => 'TF', 'name' => 'French Southern Territories', 'phonecode' => '0'],
            ['sortname' => 'GA', 'name' => 'Gabon', 'phonecode' => '241'],
            ['sortname' => 'GM', 'name' => 'Gambia The', 'phonecode' => '220'],
            ['sortname' => 'GE', 'name' => 'Georgia', 'phonecode' => '995'],
            ['sortname' => 'DE', 'name' => 'Germany', 'phonecode' =>  '49'],
            ['sortname' => 'GH', 'name' => 'Ghana', 'phonecode' => '233'],
            ['sortname' => 'GI', 'name' => 'Gibraltar', 'phonecode' => '350'],
            ['sortname' => 'GR', 'name' => 'Greece', 'phonecode' => '30'],
            ['sortname' => 'GL', 'name' => 'Greenland', 'phonecode' => '299'],
            ['sortname' => 'GD', 'name' => 'Grenada', 'phonecode' => '1473'],
            ['sortname' => 'GP', 'name' => 'Guadeloupe', 'phonecode' => '590'],
            ['sortname' => 'GU', 'name' => 'Guam', 'phonecode' => '1671'],
            ['sortname' => 'GT', 'name' => 'Guatemala', 'phonecode' => '502'],
            ['sortname' => 'XU', 'name' => 'Guernsey and Alderney', 'phonecode' => '44'],
            ['sortname' => 'GN', 'name' => 'Guinea', 'phonecode' => '224'],
            ['sortname' => 'GW', 'name' => 'Guinea-Bissau', 'phonecode' => '245'],
            ['sortname' => 'GY', 'name' => 'Guyana', 'phonecode' => '592'],
            ['sortname' => 'HT', 'name' => 'Haiti', 'phonecode' => '509'],
            ['sortname' => 'HM', 'name' => 'Heard and McDonald Islands', 'phonecode' => '0'],
            ['sortname' => 'HN', 'name' => 'Honduras', 'phonecode' => '504'],
            ['sortname' => 'HK', 'name' => 'Hong Kong S.A.R.', 'phonecode' => '852'],
            ['sortname' => 'HU', 'name' => 'Hungary', 'phonecode' => '36'],
            ['sortname' => 'IS', 'name' => 'Iceland', 'phonecode' => '354'],
            ['sortname' => 'IN', 'name' => 'India', 'phonecode' => '91'],
            ['sortname' => 'ID', 'name' => 'Indonesia', 'phonecode' => '62'],
            ['sortname' => 'IR', 'name' => 'Iran', 'phonecode' => '98'],
            ['sortname' => 'IQ', 'name' => 'Iraq', 'phonecode' => '964'],
            ['sortname' => 'IE', 'name' => 'Ireland', 'phonecode' => '353'],
            ['sortname' => 'IL', 'name' => 'Israel', 'phonecode' => '972'],
            ['sortname' => 'IT', 'name' => 'Italy', 'phonecode' => '39'],
            ['sortname' => 'JM', 'name' => 'Jamaica', 'phonecode' => '1876'],
            ['sortname' => 'JP', 'name' => 'Japan', 'phonecode' => '81'],
            ['sortname' => 'XJ', 'name' => 'Jersey', 'phonecode' => '44'],
            ['sortname' => 'JO', 'name' => 'Jordan', 'phonecode' => '962'],
            ['sortname' => 'KZ', 'name' => 'Kazakhstan', 'phonecode' => '7'],
            ['sortname' => 'KE', 'name' => 'Kenya', 'phonecode' => '254'],
            ['sortname' => 'KI', 'name' => 'Kiribati', 'phonecode' => '686'],
            ['sortname' => 'KP', 'name' => 'Korea North', 'phonecode' => '850'],
            ['sortname' => 'KR', 'name' => 'Korea South', 'phonecode' => '82'],
            ['sortname' => 'KW', 'name' => 'Kuwait', 'phonecode' => '965'],
            ['sortname' => 'KG', 'name' => 'Kyrgyzstan', 'phonecode' => '996'],
            ['sortname' => 'LA', 'name' => 'Laos', 'phonecode' => '856'],
            ['sortname' => 'LV', 'name' => 'Latvia', 'phonecode' => '371'],
            ['sortname' => 'LB', 'name' => 'Lebanon', 'phonecode' => '961'],
            ['sortname' => 'LS', 'name' => 'Lesotho', 'phonecode' => '266'],
            ['sortname' => 'LR', 'name' => 'Liberia', 'phonecode' => '231'],
            ['sortname' => 'LY', 'name' => 'Libya', 'phonecode' => '218'],
            ['sortname' => 'LI', 'name' => 'Liechtenstein', 'phonecode' => '423'],
            ['sortname' => 'LT', 'name' => 'Lithuania', 'phonecode' => '370'],
            ['sortname' => 'LU', 'name' => 'Luxembourg', 'phonecode' => '352'],
            ['sortname' => 'MO', 'name' => 'Macau S.A.R.', 'phonecode' => '853'],
            ['sortname' => 'MK', 'name' => 'Macedonia', 'phonecode' => '389'],
            ['sortname' => 'MG', 'name' => 'Madagascar', 'phonecode' => '261'],
            ['sortname' => 'MW', 'name' => 'Malawi', 'phonecode' => '265'],
            ['sortname' => 'MY', 'name' => 'Malaysia', 'phonecode' => '60'],
            ['sortname' => 'MV', 'name' => 'Maldives', 'phonecode' => '960'],
            ['sortname' => 'ML', 'name' => 'Mali', 'phonecode' => '223'],
            ['sortname' => 'MT', 'name' => 'Malta', 'phonecode' => '356'],
            ['sortname' => 'XM', 'name' => 'Man (Isle of]', 'phonecode' => '44'],
            ['sortname' => 'MH', 'name' => 'Marshall Islands', 'phonecode' => '692'],
            ['sortname' => 'MQ', 'name' => 'Martinique', 'phonecode' => '596'],
            ['sortname' => 'MR', 'name' => 'Mauritania', 'phonecode' => '222'],
            ['sortname' => 'MU', 'name' => 'Mauritius', 'phonecode' => '230'],
            ['sortname' => 'YT', 'name' => 'Mayotte', 'phonecode' => '269'],
            ['sortname' => 'MX', 'name' => 'Mexico', 'phonecode' => '52'],
            ['sortname' => 'FM', 'name' => 'Micronesia', 'phonecode' => '691'],
            ['sortname' => 'MD', 'name' => 'Moldova', 'phonecode' => '373'],
            ['sortname' => 'MC', 'name' => 'Monaco', 'phonecode' => '377'],
            ['sortname' => 'MN', 'name' => 'Mongolia', 'phonecode' => '976'],
            ['sortname' => 'MS', 'name' => 'Montserrat', 'phonecode' => '1664'],
            ['sortname' => 'MA', 'name' => 'Morocco', 'phonecode' => '212'],
            ['sortname' => 'MZ', 'name' => 'Mozambique', 'phonecode' => '258'],
            ['sortname' => 'MM', 'name' => 'Myanmar', 'phonecode' => '95'],
            ['sortname' => 'NA', 'name' => 'Namibia', 'phonecode' => '264'],
            ['sortname' => 'NR', 'name' => 'Nauru', 'phonecode' => '674'],
            ['sortname' => 'NP', 'name' => 'Nepal', 'phonecode' => '977'],
            ['sortname' => 'AN', 'name' => 'Netherlands Antilles', 'phonecode' => '599'],
            ['sortname' => 'NL', 'name' => 'Netherlands The', 'phonecode' => '31'],
            ['sortname' => 'NC', 'name' => 'New Caledonia', 'phonecode' =>  '687'],
            ['sortname' => 'NZ', 'name' => 'New Zealand', 'phonecode' => '64'],
            ['sortname' => 'NI', 'name' => 'Nicaragua', 'phonecode' => '505'],
            ['sortname' => 'NE', 'name' => 'Niger', 'phonecode' => '227'],
            ['sortname' => 'NG', 'name' => 'Nigeria', 'phonecode' => '234'],
            ['sortname' => 'NU', 'name' => 'Niue', 'phonecode' =>  '683'],
            ['sortname' => 'NF', 'name' => 'Norfolk Island', 'phonecode' => '672'],
            ['sortname' => 'MP', 'name' => 'Northern Mariana Islands', 'phonecode' => '1670'],
            ['sortname' => 'NO', 'name' => 'Norway', 'phonecode' => '47'],
            ['sortname' => 'OM', 'name' => 'Oman', 'phonecode' => '968'],
            ['sortname' => 'PK', 'name' => 'Pakistan', 'phonecode' =>  '92'],
            ['sortname' => 'PW', 'name' => 'Palau', 'phonecode' => '680'],
            ['sortname' => 'PS', 'name' => 'Palestinian Territory Occupied', 'phonecode' => '970'],
            ['sortname' => 'PA', 'name' => 'Panama', 'phonecode' => '507'],
            ['sortname' => 'PG', 'name' => 'Papua new Guinea', 'phonecode' => '675'],
            ['sortname' => 'PY', 'name' => 'Paraguay', 'phonecode' => '595'],
            ['sortname' => 'PE', 'name' => 'Peru', 'phonecode' => '51'],
            ['sortname' => 'PH', 'name' => 'Philippines', 'phonecode' => '63'],
            // ['sortname' => 'PN', 'name' => 'Pitcairn Island', 'phonecode' => '0'],
            ['sortname' => 'PL', 'name' => 'Poland', 'phonecode' => '48'],
            ['sortname' => 'PT', 'name' => 'Portugal', 'phonecode' => '351'],
            ['sortname' => 'PR', 'name' => 'Puerto Rico', 'phonecode' => '1787'],
            ['sortname' => 'QA', 'name' => 'Qatar', 'phonecode' => '974'],
            ['sortname' => 'RE', 'name' => 'Reunion', 'phonecode' => '262'],
            ['sortname' => 'RO', 'name' => 'Romania', 'phonecode' => '40'],
            ['sortname' => 'RU', 'name' => 'Russia', 'phonecode' => '70'],
            ['sortname' => 'RW', 'name' => 'Rwanda', 'phonecode' => '250'],
            ['sortname' => 'SH', 'name' => 'Saint Helena', 'phonecode' => '290'],
            ['sortname' => 'KN', 'name' => 'Saint Kitts And Nevis', 'phonecode' => '1869'],
            ['sortname' => 'LC', 'name' => 'Saint Lucia', 'phonecode' => '1758'],
            ['sortname' => 'PM', 'name' => 'Saint Pierre and Miquelon', 'phonecode' => '508'],
            ['sortname' => 'VC', 'name' => 'Saint Vincent And The Grenadines', 'phonecode' => '1784'],
            ['sortname' => 'WS', 'name' => 'Samoa', 'phonecode' => '684'],
            ['sortname' => 'SM', 'name' => 'San Marino', 'phonecode' => '378'],
            ['sortname' => 'ST', 'name' => 'Sao Tome and Principe', 'phonecode' => '239'],
            ['sortname' => 'SA', 'name' => 'Saudi Arabia', 'phonecode' => '966'],
            ['sortname' => 'SN', 'name' => 'Senegal', 'phonecode' => '221'],
            ['sortname' => 'RS', 'name' => 'Serbia', 'phonecode' => '381'],
            ['sortname' => 'SC', 'name' => 'Seychelles', 'phonecode' => '248'],
            ['sortname' => 'SL', 'name' => 'Sierra Leone', 'phonecode' => '232'],
            ['sortname' => 'SG', 'name' => 'Singapore', 'phonecode' => '65'],
            ['sortname' => 'SK', 'name' => 'Slovakia', 'phonecode' => '421'],
            ['sortname' => 'SI', 'name' => 'Slovenia', 'phonecode' => '386'],
            ['sortname' => 'XG', 'name' => 'Smaller Territories of the UK', 'phonecode' => '44'],
            ['sortname' => 'SB', 'name' => 'Solomon Islands', 'phonecode' => '677'],
            ['sortname' => 'SO', 'name' => 'Somalia', 'phonecode' => '252'],
            ['sortname' => 'ZA', 'name' => 'South Africa', 'phonecode' => '27'],
            // ['sortname' => 'GS', 'name' => 'South Georgia', 'phonecode' => '0'],
            ['sortname' => 'SS', 'name' => 'South Sudan', 'phonecode' => '211'],
            ['sortname' => 'ES', 'name' => 'Spain', 'phonecode' => '34'],
            ['sortname' => 'LK', 'name' => 'Sri Lanka', 'phonecode' => '94'],
            ['sortname' => 'SD', 'name' => 'Sudan', 'phonecode' => '249'],
            ['sortname' => 'SR', 'name' => 'Suriname', 'phonecode' => '597'],
            // ['sortname' => 'SJ', 'name' => 'Svalbard And Jan Mayen Islands','phonecode' => '47'],
            ['sortname' => 'SZ', 'name' => 'Swaziland', 'phonecode' => '268'],
            ['sortname' => 'SE', 'name' => 'Sweden', 'phonecode' => '46'],
            ['sortname' => 'CH', 'name' => 'Switzerland', 'phonecode' => '41'],
            ['sortname' => 'SY', 'name' => 'Syria', 'phonecode' => '963'],
            ['sortname' => 'TW', 'name' => 'Taiwan', 'phonecode' => '886'],
            ['sortname' => 'TJ', 'name' => 'Tajikistan', 'phonecode' => '992'],
            ['sortname' => 'TZ', 'name' => 'Tanzania', 'phonecode' => '255'],
            ['sortname' => 'TH', 'name' => 'Thailand', 'phonecode' => '66'],
            ['sortname' => 'TG', 'name' => 'Togo', 'phonecode' => '228'],
            ['sortname' => 'TK', 'name' => 'Tokelau', 'phonecode' => '690'],
            ['sortname' => 'TO', 'name' => 'Tonga', 'phonecode' => '676'],
            ['sortname' => 'TT', 'name' => 'Trinidad And Tobago', 'phonecode' => '1868'],
            ['sortname' => 'TN', 'name' => 'Tunisia', 'phonecode' =>  '216'],
            ['sortname' => 'TR', 'name' => 'Turkey', 'phonecode' =>  '90'],
            ['sortname' => 'TM', 'name' => 'Turkmenistan', 'phonecode' =>  '7370'],
            ['sortname' => 'TC', 'name' => 'Turks And Caicos Islands', 'phonecode' => '1649'],
            ['sortname' => 'TV', 'name' => 'Tuvalu', 'phonecode' => '688'],
            ['sortname' => 'UG', 'name' => 'Uganda', 'phonecode' => '256'],
            ['sortname' => 'UA', 'name' => 'Ukraine', 'phonecode' => '380'],
            ['sortname' => 'AE', 'name' => 'United Arab Emirates', 'phonecode' =>  '971'],
            // ['sortname' => 'GB', 'name' => 'United Kingdom', 'phonecode' => '44'],
            ['sortname' => 'US', 'name' => 'United States', 'phonecode' => '1'],
            // ['sortname' => 'UM', 'name' => 'United States Minor Outlying Islands', 'phonecode' => '1'],
            ['sortname' => 'UY', 'name' => 'Uruguay', 'phonecode' => '598'],
            ['sortname' => 'UZ', 'name' => 'Uzbekistan', 'phonecode' => '998'],
            ['sortname' => 'VU', 'name' => 'Vanuatu', 'phonecode' =>  '678'],
            ['sortname' => 'VA', 'name' => 'Vatican City State (Holy See]', 'phonecode' => '39'],
            ['sortname' => 'VE', 'name' => 'Venezuela', 'phonecode' => '58'],
            ['sortname' => 'VN', 'name' => 'Vietnam', 'phonecode' => '84'],
            ['sortname' => 'VG', 'name' => 'Virgin Islands (British]', 'phonecode' => '1284'],
            ['sortname' => 'VI', 'name' => 'Virgin Islands (US]', 'phonecode' => '1340'],
            ['sortname' => 'WF', 'name' => 'Wallis And Futuna Islands', 'phonecode' => '681'],
            ['sortname' => 'EH', 'name' => 'Western Sahara', 'phonecode' => '212'],
            ['sortname' => 'YE', 'name' => 'Yemen', 'phonecode' =>  '967'],
            ['sortname' => 'YU', 'name' => 'Yugoslavia', 'phonecode' => '38'],
            ['sortname' => 'ZM', 'name' => 'Zambia', 'phonecode' => '260'],
            ['sortname' => 'ZW', 'name' => 'Zimbabwe', 'phonecode' => '263']
        ];

        DB::table('countries')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
