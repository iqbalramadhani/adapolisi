<x-base-layout>

    {{ theme()->getView('pages/account/settings/_data-kejadian', array('class' => 'mb-5 mb-xl-10', 'jobs' => $jobs, 'provinces' => $provinces, 'crimes' => $crimes, 'crime_perpetrator_targets' => $crime_perpetrator_targets, 'crime_potential_targets' => $crime_potential_targets, 'equipments' => $equipments, 'how_get_equipments' => $how_get_equipments, 'motives' => $motives, 'time_patterns' => $time_patterns, 'vehicles' => $vehicles, 'crime_modes' => $crime_modes)) }}

</x-base-layout>
