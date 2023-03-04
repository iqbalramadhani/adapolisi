<x-base-layout>

    {{ theme()->getView('pages/account/overview/_edit-perpetrator-offender', array('class' => 'mb-5 mb-xl-10', 'perpetrator_info' => $perpetrator_info, 'offender' => $offender, 'offender_images' => $offender_images, 'internal_visit_images' => $internal_visit_images, 'external_visit_images' => $external_visit_images, 'jobs' => $jobs, 'provinces' => $provinces, 'selected_province' => $selected_province, 'selected_city' => $selected_city, 'selected_district' => $selected_district, 'selected_village' => $selected_village, 'crimes' => $crimes, 'crime_perpetrator_targets' => $crime_perpetrator_targets, 'crime_potential_targets' => $crime_potential_targets, 'equipments' => $equipments, 'how_get_equipments' => $how_get_equipments, 'motives' => $motives, 'time_patterns' => $time_patterns, 'vehicles' => $vehicles, 'crime_modes' => $crime_modes)) }}

</x-base-layout>
