<?php

namespace Modules\Website\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;

class ProductFactory extends Factory
{
    // /**
    //  * The name of the factory's corresponding model.
    //  */
    // protected $model = \Modules\Website\app\Models\Product::class;

    // /**
    //  * Define the model's default state.
    //  */
    // public function definition(): array
    // {
    //     return [];
    // }

    protected $model = Product::class;

    public function definition()
    {
        // $name = $this->faker->unique()->words(5, true);

        $name = [
            'Digital Thermometer',
            'Surgical Face Mask',
            'Disposable Syringe',
            'Blood Pressure Monitor',
            'ECG Machine',
            'Examination Gloves',
            'Surgical Scissors',
            'Cotton Rolls',
            'Sterile Gauze Pads',
            'Wheelchair',
            'Stethoscope',
            'IV Drip Stand',
            'Oxygen Concentrator',
            'Hospital Bed',
            'Nasal Cannula',
            'Alcohol Swabs',
            'Pulse Oximeter',
            'Patient Monitor',
            'Surgical Drapes',
            'Disposable Gown',
            'Urine Collection Bag',
            'Anesthesia Mask',
            'Crutches',
            'Portable Ultrasound',
            'Bandage Rolls',
            'Medical Forceps',
            'Glucose Test Strips',
            'Nebulizer Kit',
            'First Aid Kit',
            'Defibrillator Pads',
            'Infusion Pump',
            'Bone Saw',
            'Otoscope',
            'Reflex Hammer',
            'Surgical Sutures',
            'Cannula',
            'Medical Trolley',
            'X-ray Film',
            'Hospital Curtains',
            'PPE Kit',
            'Blood Collection Tubes',
            'Oxygen Mask',
            'Sharps Container',
            'Thermometer Strips',
            'Digital Weighing Scale',
            'Cervical Collar',
            'Specimen Container',
            'Wound Dressing Kit',
            'Tongue Depressors',
            'Blood Lancets',
            'Tourniquet',
            'Medical Tape',
            'Oxygen Cylinder',
            'Insulin Pen Needles',
            'Suction Catheter',
            'Bedside Table',
            'ECG Electrodes',
            'Biohazard Bags',
            'Surgical Blades',
            'Diagnostic Penlight',
            'Medical Apron',
            'Vaginal Speculum',
            'Sphygmomanometer',
            'Pulse Monitor',
            'Surgical Stapler',
            'Airway Tube',
            'IV Cannula',
            'Urinal Bottle',
            'Disinfectant Solution',
            'Examination Couch',
            'Anti-decubitus Mattress',
            'Digital Glucometer',
            'Infusion Set',
            'Arm Sling',
            'Nebulization Mask',
            'Thermometer Probe Covers',
            'Oxygen Regulator',
            'Trauma Shears',
            'Surgical Retractor',
            'Examination Light',
            'Hospital Mattress',
            'Insulin Syringe',
            'Bed Pan',
            'Feeding Tube',
            'Disposable Cap',
            'ECG Gel',
            'Diagnostic Kit',
            'Medical Gown',
            'Sterile Gloves',
            'Face Shield',
            'IV Infusion Bottle',
            'BP Cuff',
            'Otoscope Specula',
            'CPR Mask',
            'Capnography Sensor',
            'Alcohol-Based Hand Rub',
            'Diagnostic Scale',
            'Medical Waste Bin',
            'X-Ray Apron',
            'ICU Monitor',
        ];
        $descriptions = [
            'Measures body temperature accurately and quickly.',
            'Protects against airborne particles and pathogens.',
            'Used for injecting medications or withdrawing fluids.',
            'Monitors and records blood pressure readings.',
            'Records the heart’s electrical activity.',
            'Protects hands from contamination during procedures.',
            'Used to cut tissue during surgical procedures.',
            'Soft cotton used for wound care or cleaning.',
            'Sterile pads for wound coverage and absorption.',
            'Provides mobility assistance to patients.',
            'Used to listen to heart, lung, and body sounds.',
            'Holds IV fluids for patient infusion.',
            'Delivers oxygen to patients with respiratory issues.',
            'Adjustable bed designed for hospital patients.',
            'Delivers oxygen directly through the nose.',
            'Used to disinfect skin before injections.',
            'Monitors blood oxygen saturation and pulse rate.',
            'Displays real-time vital signs of a patient.',
            'Covers the patient and maintains sterile field.',
            'Worn to protect body during medical procedures.',
            'Collects urine from patients who are immobile.',
            'Administers anesthesia gases during surgery.',
            'Helps support mobility for injured patients.',
            'Portable imaging device for diagnostics.',
            'Used to wrap and protect wounds.',
            'Grasps or holds tissues during surgery.',
            'Used for blood glucose level testing.',
            'Delivers medication as a fine mist to lungs.',
            'Essential kit for emergency first aid treatment.',
            'Pads used with defibrillator to restore heartbeat.',
            'Regulates and delivers controlled IV fluids.',
            'Used for cutting bones during surgeries.',
            'Examines ears and ear canals.',
            'Tests reflexes for neurological examination.',
            'Stitches used to close wounds or incisions.',
            'Flexible tube for delivering or draining fluids.',
            'Moves supplies and equipment in hospitals.',
            'Used in radiology for capturing X-ray images.',
            'Provides privacy in medical settings.',
            'Includes essential personal protective gear.',
            'Holds blood for lab analysis or transfusion.',
            'Covers nose and mouth for oxygen delivery.',
            'Disposal container for needles and sharps.',
            'Simple heat-sensitive strips for checking fever.',
            'Weighs patients accurately in clinics or hospitals.',
            'Supports neck injuries and spinal alignment.',
            'Stores biological specimens for lab testing.',
            'Kit containing items for wound cleaning and dressing.',
            'Flat sticks used to depress the tongue for exams.',
            'Used for blood sampling with finger pricks.',
            'Applies pressure to veins during venipuncture.',
            'Used to secure bandages or medical devices.',
            'Portable tank for storing medical oxygen.',
            'Used for subcutaneous injection of insulin.',
            'Tube for removing fluids from airways.',
            'Furniture placed next to hospital beds.',
            'Electrodes for monitoring heart activity.',
            'Safe disposal of biohazard medical waste.',
            'Scalpels or blades for incisions.',
            'Light pen for checking pupil response.',
            'Worn to protect clothing during procedures.',
            'Tool for gynecological examinations.',
            'Measures blood pressure manually.',
            'Tracks pulse rate for monitoring vitals.',
            'Used to staple tissues during surgery.',
            'Inserted into the airway to aid breathing.',
            'Device inserted into veins for IV therapy.',
            'Collects urine for patients with limited mobility.',
            'Used to disinfect surfaces or instruments.',
            'Adjustable table for patient exams.',
            'Mattress designed to prevent bedsores.',
            'Measures blood glucose levels digitally.',
            'Delivers IV fluids to patients.',
            'Supports the arm during injury recovery.',
            'Mask used for administering nebulized meds.',
            'Protects thermometer probe for hygiene.',
            'Controls oxygen flow from cylinders.',
            'Heavy-duty scissors for cutting clothing or tape.',
            'Retracts tissue during surgical procedures.',
            'Illuminates the body during examination.',
            'Comfortable mattress for hospital beds.',
            'Used for precise insulin administration.',
            'Collects bodily waste for non-mobile patients.',
            'Tube used for feeding patients unable to swallow.',
            'Protects hair in sterile environments.',
            'Gel for better ECG conductivity on skin.',
            'Includes tools for rapid diagnostics.',
            'Worn to cover body in surgical settings.',
            'Used for sterile procedures and surgeries.',
            'Protects the face from splashes and droplets.',
            'Bottled IV fluids for patient infusion.',
            'Cuff for measuring blood pressure.',
            'Disposable tip for otoscope exams.',
            'Mouthpiece for performing CPR safely.',
            'Monitors carbon dioxide in respiration.',
            'Kills bacteria on hands without water.',
            'Measures weight with medical precision.',
            'Container for safe medical waste disposal.',
            'Protects staff from radiation during X-rays.',
            'Tracks and displays ICU patient vitals.',
        ];
        shuffle($name);
        shuffle($descriptions);
        return [
            'name'        => array_pop($name),
            'description' => array_pop($descriptions),
            'slug'        => Str::slug(array_pop($name)),
            'store_id'   => $this->faker->numberBetween(1, 10), // Assuming you have 10 stores
            'brand'       => $this->faker->randomElement(['Brand A', 'Brand B', 'Brand C']),
            'weight'      => $this->faker->randomFloat(2, 0.1, 10), // weight between 0.1 and 10
            'price'       => $this->faker->randomFloat(2, 10, 1000),
            'discount'    => $this->faker->boolean(30) ? $this->faker->randomFloat(2, 1, 100) : 0,
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'gallery'     => $this->faker->randomElements([
                'assets/img/product/01.png',
                'assets/img/product/02.png',
                'assets/img/product/03.png',
                'assets/img/product/04.png',
                'assets/img/product/05.png',
                'assets/img/product/06.png',
                'assets/img/product/07.png',
                'assets/img/product/08.png',
                'assets/img/product/09.png',
                'assets/img/product/10.png',
            ], 3, false), // 3 random images

            'image'       => $this->faker->randomElement([
                'assets/img/product/01.png',
                'assets/img/product/02.png',
                'assets/img/product/03.png',
                'assets/img/product/04.png',
                'assets/img/product/05.png',
                'assets/img/product/06.png',
                'assets/img/product/07.png',
                'assets/img/product/08.png',
                'assets/img/product/09.png',
                'assets/img/product/10.png',
                'assets/img/product/11.png',
                'assets/img/product/12.png',
                'assets/img/product/13.png',
                'assets/img/product/14.png',
                'assets/img/product/15.png',
                'assets/img/product/16.png',
                'assets/img/product/17.png',
                'assets/img/product/18.png',
                'assets/img/product/19.png',
                'assets/img/product/20.png',
                'assets/img/product/21.png',
                'assets/img/product/22.png',
                'assets/img/product/23.png',
                'assets/img/product/24.png',
                'assets/img/product/25.png',
                'assets/img/product/26.png',
                'assets/img/product/27.png',
                'assets/img/product/30.png',
                'assets/img/product/31.png',
                'assets/img/product/32.png',
                'assets/img/product/33.png',
                'assets/img/product/34.png',
                'assets/img/product/35.png',
                'assets/img/product/36.png',
                'assets/img/product/37.png',
            ]),
            'code'        => strtoupper($this->faker->bothify('??###')),
            'tax'         => $this->faker->randomFloat(2, 0, 0.3), // e.g., 0 to 30% tax
            'rating'      => $this->faker->randomFloat(1, 0, 5),    // rating between 0 and 5
            'is_new'      => $this->faker->boolean(50),
            'stock'       => $this->faker->numberBetween(0, 100),
            'quantity'    => $this->faker->numberBetween(1, 200),
            'options'     => json_encode([]), // or add some options as needed
            'status'      => $this->faker->randomElement(['active', 'draft', 'archived']),
        ];
    }
}

