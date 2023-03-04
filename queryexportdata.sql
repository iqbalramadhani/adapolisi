SELECT perpetrators.*, (select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status in (1,2)) as kasus_aktif, (select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status = 3) as kasus_ditutup, users.full_name as admin_name, master_list_polres.name as polres_name, 
CASE 
	WHEN offender_crime_indications.crime_key = 'App/Model/MasterListCrimeOfPotentialTarget' THEN (SELECT name FROM master_list_crime_of_potential_targets WHERE id = offender_crime_indications.crime_id)
    WHEN offender_crime_indications.crime_key = 'App/Model/MasterListCrimeOfPerpetratorTarget' THEN (SELECT name FROM master_list_crime_of_perpetrator_targets WHERE id = offender_crime_indications.crime_id)
END as kejahatan,
offender_crime_indications.date_incident as tanggal_kasus, master_list_equipment.name as senjata, master_list_motives.name as motif, 
master_list_time_patterns.name as waktu_kejadian,
offender_crime_indications.location_incident as lokasi_kejadian,
offender_crime_indications.rt as rt,
offender_crime_indications.rw as rw,
(SELECT name from indonesia_provinces where id = offender_crime_indications.province_id) as lokasi_provinsi,
(SELECT name from indonesia_cities where code = offender_crime_indications.city_id) as lokasi_kota,
(SELECT name from indonesia_districts where code = offender_crime_indications.district_id) as lokasi_kecamatan,
IF(offenders.type = '1', 'Potensi', 'Pelaku') as jenis, 
CASE 
	WHEN offenders.status = 1 THEN 'Pendataan' 
    WHEN offenders.status = 2 THEN 'Tindakan' ELSE 'Ditutup' 
END as status
FROM perpetrators
JOIN offenders ON offenders.perpetrator_id = perpetrators.id
JOIN offender_crime_indications ON offender_crime_indications.offender_id = offenders.id
LEFT JOIN master_list_time_patterns ON master_list_time_patterns.id = offender_crime_indications.time_id
LEFT JOIN master_list_equipment ON master_list_equipment.id = offender_crime_indications.equipment_id
LEFT JOIN master_list_motives ON master_list_motives.id = offender_crime_indications.motives_id
JOIN users ON users.id = offenders.admin_id
JOIN master_list_polres ON master_list_polres.id = users.polres_code;