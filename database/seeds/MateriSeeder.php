<?php

use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $posts = [
        			['name'=>'Business Acumen'],['name'=>'Business Etiquette'],['name'=>'Call Center'],['name'=>'Coaching & Mentoring'],['name'=>'Collection Management'],['name'=>'Commitment'],['name'=>'Communication Skill'],['name'=>'Creative Thinking Technique'],['name'=>'Effective Meeting'],['name'=>'Ekspresi Suara'],['name'=>'Emotional Intelligence'],['name'=>'Entrepreneurial Marketing'],['name'=>'Financial Planning'],['name'=>'Generation GAP'],['name'=>'Leadership Excellance'],['name'=>'Make up class'],['name'=>'Managerial Skill'],['name'=>'Maximize Your Strength'],['name'=>'Media Relation'],['name'=>'Negotiation Skill'],['name'=>'Presentation Skill'],['name'=>'Problem Solving - Decision Making'],['name'=>'Profesional Appearance'],['name'=>'Protokoler'],['name'=>'Public Relations'],['name'=>'Public Speaking'],['name'=>'Risk Management'],['name'=>'Role Awareness'],['name'=>'Secretary & P A Skill'],['name'=>'Selling Skills'],['name'=>'Service Excellance'],['name'=>'Smart Thinking (Skills for critical Understanding)'],['name'=>'Speed Thinking'],['name'=>'Stress Management'],['name'=>'Table Manners'],['name'=>'Total Image'],['name'=>'Train The Trainers'],['name'=>'Training Need Analysis']
        	   	];

        // masukkan data ke database
		DB::table('materis')->insert($posts);
    }
}
