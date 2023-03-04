<?php

namespace Database\Seeders;

use App\Models\MasterListPolsek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterListPolsekSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $polsek = [
      ['polres_code' => 1, 'name' => 'POLSEK METRO GAMBIR'],
      ['polres_code' => 1, 'name' => 'POLSEK METRO MENTENG'],
      ['polres_code' => 1, 'name' => 'POLSEK METRO TNH ABANG'],
      ['polres_code' => 1, 'name' => 'POLSEK CEMPAKA PUTIH'],
      ['polres_code' => 1, 'name' => 'POLSEK JOHAR BARU'],
      ['polres_code' => 1, 'name' => 'POLSEK KEMAYORAN'],
      ['polres_code' => 1, 'name' => 'POLSEK SAWAH BESAR'],
      ['polres_code' => 1, 'name' => 'POLSEK SENEN'],
      ['polres_code' => 2, 'name' => 'POLSEK METRO PENJARINGAN'],
      ['polres_code' => 2, 'name' => 'POLSEK CILINCING'],
      ['polres_code' => 2, 'name' => 'POLSEK KELAPA GADING'],
      ['polres_code' => 2, 'name' => 'POLSEK KOJA'],
      ['polres_code' => 2, 'name' => 'POLSEK PADEMANGAN'],
      ['polres_code' => 2, 'name' => 'POLSEK TANJUNG PRIOK'],
      ['polres_code' => 3, 'name' => 'POLSEK METRO TAMAN SARI'],
      ['polres_code' => 3, 'name' => 'POLSEK CENGKARENG'],
      ['polres_code' => 3, 'name' => 'POLSEK KALIDERES'],
      ['polres_code' => 3, 'name' => 'POLSEK KEBON JERUK'],
      ['polres_code' => 3, 'name' => 'POLSEK KEMBANGAN'],
      ['polres_code' => 3, 'name' => 'POLSEK PALMERAH'],
      ['polres_code' => 3, 'name' => 'POLSEK TAMBORA'],
      ['polres_code' => 3, 'name' => 'POLSEK TANJUNG DUREN'],
      ['polres_code' => 4, 'name' => 'POLSEK METRO KEB. BARU'],
      ['polres_code' => 4, 'name' => 'POLSEK METRO SETIA BUDI'],
      ['polres_code' => 4, 'name' => 'POLSEK CILANDAK'],
      ['polres_code' => 4, 'name' => 'POLSEK JAGAKARSA'],
      ['polres_code' => 4, 'name' => 'POLSEK KEBAYORAN LAMA'],
      ['polres_code' => 4, 'name' => 'POLSEK MAMPANG'],
      ['polres_code' => 4, 'name' => 'POLSEK PANCORAN'],
      ['polres_code' => 4, 'name' => 'POLSEK PANCORAN'],
      ['polres_code' => 4, 'name' => 'POLSEK PASAR MINGGU'],
      ['polres_code' => 4, 'name' => 'POLSEK PESANGGRAHAN'],
      ['polres_code' => 4, 'name' => 'POLSEK TEBET'],
      ['polres_code' => 5, 'name' => 'POLSEK CAKUNG'],
      ['polres_code' => 5, 'name' => 'POLSEK CIPAYUNG'],
      ['polres_code' => 5, 'name' => 'POLSEK CIRACAS'],
      ['polres_code' => 5, 'name' => 'POLSEK DUREN SAWIT'],
      ['polres_code' => 5, 'name' => 'POLSEK JATINEGARA'],
      ['polres_code' => 5, 'name' => 'POLSEK KRAMAT JATI'],
      ['polres_code' => 5, 'name' => 'POLSEK MAKASAR'],
      ['polres_code' => 5, 'name' => 'POLSEK MATRAMAN'],
      ['polres_code' => 5, 'name' => 'POLSEK PASAR REBO'],
      ['polres_code' => 5, 'name' => 'POLSEK PULOGADUNG'],
      ['polres_code' => 6, 'name' => 'POLSEK BATUCEPER'],
      ['polres_code' => 6, 'name' => 'POLSEK BENDA'],
      ['polres_code' => 6, 'name' => 'POLSEK CILEDUG'],
      ['polres_code' => 6, 'name' => 'POLSEK CIPONDOH'],
      ['polres_code' => 6, 'name' => 'POLSEK JATIUWUNG'],
      ['polres_code' => 6, 'name' => 'POLSEK KARAWACI'],
      ['polres_code' => 6, 'name' => 'POLSEK NEGLASARI'],
      ['polres_code' => 6, 'name' => 'POLSEK TANGERANG'],
      ['polres_code' => 6, 'name' => 'POLSEK SEPATAN'],
      ['polres_code' => 6, 'name' => 'POLSEK PAKUHAJI'],
      ['polres_code' => 6, 'name' => 'POLSEK TELUK NAGA'],
      ['polres_code' => 6, 'name' => 'POLSEK PINANG'],
      ['polres_code' => 7, 'name' => 'POLSEK BANTAR GEBANG'],
      ['polres_code' => 7, 'name' => 'POLSEK BEKASI KOTA'],
      ['polres_code' => 7, 'name' => 'POLSEK BEKASI SELATAN'],
      ['polres_code' => 7, 'name' => 'POLSEK BEKASI TIMUR'],
      ['polres_code' => 7, 'name' => 'POLSEK BEKASI UTARA'],
      ['polres_code' => 7, 'name' => 'POLSEK JATI ASIH'],
      ['polres_code' => 7, 'name' => 'POLSEK MEDAN SATRIA'],
      ['polres_code' => 7, 'name' => 'POLSEK PONDOK GEDE'],
      ['polres_code' => 7, 'name' => 'POLSEK JATI SAMPURNA'],
      ['polres_code' => 8, 'name' => 'POLSEK CIKARANG BARAT'],
      ['polres_code' => 8, 'name' => 'POLSEK CIKARANG'],
      ['polres_code' => 8, 'name' => 'POLSEK CIKARANG SELATAN'],
      ['polres_code' => 8, 'name' => 'POLSEK CIKARANG TIMUR'],
      ['polres_code' => 8, 'name' => 'POLSEK PEBAYURAN'],
      ['polres_code' => 8, 'name' => 'POLSEK TAMBUN'],
      ['polres_code' => 8, 'name' => 'POLSEK BABELAN'],
      ['polres_code' => 8, 'name' => 'POLSEK CABANG BUNGIN'],
      ['polres_code' => 8, 'name' => 'POLSEK CIBARUSAH'],
      ['polres_code' => 8, 'name' => 'POLSEK CIKARANG PUSAT'],
      ['polres_code' => 8, 'name' => 'POLSEK KEDUNG WARINGIN'],
      ['polres_code' => 8, 'name' => 'POLSEK MUARA GEMBONG'],
      ['polres_code' => 8, 'name' => 'POLSEK SERANG BARU'],
      ['polres_code' => 8, 'name' => 'POLSEK SETU'],
      ['polres_code' => 8, 'name' => 'POLSEK SUKATANI'],
      ['polres_code' => 8, 'name' => 'POLSEK TAMBELANG'],
      ['polres_code' => 8, 'name' => 'POLSEK TARUMA JAYA'],
      ['polres_code' => 9, 'name' => 'POLSEK BEJI'],
      ['polres_code' => 9, 'name' => 'POLSEK BOJONG GEDE'],
      ['polres_code' => 9, 'name' => 'POLSEK CIMANGGIS'],
      ['polres_code' => 9, 'name' => 'POLSEK CINERE'],
      ['polres_code' => 9, 'name' => 'POLSEK PANCORAN MAS'],
      ['polres_code' => 9, 'name' => 'POLSEK BOJONGSARI'],
      ['polres_code' => 9, 'name' => 'POLSEK SUKMAJAYA'],
      ['polres_code' => 9, 'name' => 'POLSEK TAJUR HALANG'],
      ['polres_code' => 10, 'name' => 'POLSEK KAWASAN KALIBARU'],
      ['polres_code' => 10, 'name' => 'POLSEK KAW. SUNDA KELAPA'],
      ['polres_code' => 10, 'name' => 'POLSEK KAW. MUARA BARU'],
      ['polres_code' => 11, 'name' => 'POLSEK KEP. SERIBU SELATAN'],
      ['polres_code' => 11, 'name' => 'POLSEK KEP. SERIBU UTARA'],
      ['polres_code' => 12, 'name' => 'POLSEK CIPUTAT TIMUR'],
      ['polres_code' => 12, 'name' => 'POLSEK CISAUK'],
      ['polres_code' => 12, 'name' => 'POLSEK PAMULANG'],
      ['polres_code' => 12, 'name' => 'POLSEK PONDOK AREN'],
      ['polres_code' => 12, 'name' => 'POLSEK SERPONG'],
      ['polres_code' => 12, 'name' => 'POLSEK KELAPA DUA'],
      ['polres_code' => 12, 'name' => 'POLSEK CURUG'],
      ['polres_code' => 12, 'name' => 'POLSEK LEGOK'],
      ['polres_code' => 12, 'name' => 'POLSEK PAGEDANGAN'],
    ];

    MasterListPolsek::insert($polsek);
  }
}
