<?php

namespace LolApi\Classes\LolStaticData;

/**
 * BasicDataStatsDto
 * This object contains basic data stats.
 * @author Javier
 */
class BasicDataStatsDto {

    /** @var double */
    public $FlatArmorMod;
    /** @var double */
    public $FlatAttackSpeedMod;
    /** @var double */
    public $FlatBlockMod;
    /** @var double */
    public $FlatCritChanceMod;
    /** @var double */
    public $FlatCritDamageMod;
    /** @var double */
    public $FlatEXPBonus;
    /** @var double */
    public $FlatEnergyPoolMod;
    /** @var double */
    public $FlatEnergyRegenMod;
    /** @var double */
    public $FlatHPPoolMod;
    /** @var double */
    public $FlatHPRegenMod;
    /** @var double */
    public $FlatMPPoolMod;
    /** @var double */
    public $FlatMPRegenMod;
    /** @var double */
    public $FlatMagicDamageMod;
    /** @var double */
    public $FlatMovementSpeedMod;
    /** @var double */
    public $FlatPhysicalDamageMod;
    /** @var double */
    public $FlatSpellBlockMod;
    /** @var double */
    public $PercentArmorMod;
    /** @var double */
    public $PercentAttackSpeedMod;
    /** @var double */
    public $PercentBlockMod;
    /** @var double */
    public $PercentCritChanceMod;
    /** @var double */
    public $PercentCritDamageMod;
    /** @var double */
    public $PercentDodgeMod;
    /** @var double */
    public $PercentEXPBonus;
    /** @var double */
    public $PercentHPPoolMod;
    /** @var double */
    public $PercentHPRegenMod;
    /** @var double */
    public $PercentLifeStealMod;
    /** @var double */
    public $PercentMPPoolMod;
    /** @var double */
    public $PercentMPRegenMod;
    /** @var double */
    public $PercentMagicDamageMod;
    /** @var double */
    public $PercentMovementSpeedMod;
    /** @var double */
    public $PercentPhysicalDamageMod;
    /** @var double */
    public $PercentSpellBlockMod;
    /** @var double */
    public $PercentSpellVampMod;
    /** @var double */
    public $rFlatArmorModPerLevel;
    /** @var double */
    public $rFlatArmorPenetrationMod;
    /** @var double */
    public $rFlatArmorPenetrationModPerLevel;
    /** @var double */
    public $rFlatCritChanceModPerLevel;
    /** @var double */
    public $rFlatCritDamageModPerLevel;
    /** @var double */
    public $rFlatDodgeMod;
    /** @var double */
    public $rFlatDodgeModPerLevel;
    /** @var double */
    public $rFlatEnergyModPerLevel;
    /** @var double */
    public $rFlatEnergyRegenModPerLevel;
    /** @var double */
    public $rFlatGoldPer10Mod;
    /** @var double */
    public $rFlatHPModPerLevel;
    /** @var double */
    public $rFlatHPRegenModPerLevel;
    /** @var double */
    public $rFlatMPModPerLevel;
    /** @var double */
    public $rFlatMPRegenModPerLevel;
    /** @var double */
    public $rFlatMagicDamageModPerLevel;
    /** @var double */
    public $rFlatMagicPenetrationMod;
    /** @var double */
    public $rFlatMagicPenetrationModPerLevel;
    /** @var double */
    public $rFlatMovementSpeedModPerLevel;
    /** @var double */
    public $rFlatPhysicalDamageModPerLevel;
    /** @var double */
    public $rFlatSpellBlockModPerLevel;
    /** @var double */
    public $rFlatTimeDeadMod;
    /** @var double */
    public $rFlatTimeDeadModPerLevel;
    /** @var double */
    public $rPercentArmorPenetrationMod;
    /** @var double */
    public $rPercentArmorPenetrationModPerLevel;
    /** @var double */
    public $rPercentAttackSpeedModPerLevel;
    /** @var double */
    public $rPercentCooldownMod;
    /** @var double */
    public $rPercentCooldownModPerLevel;
    /** @var double */
    public $rPercentMagicPenetrationMod;
    /** @var double */
    public $rPercentMagicPenetrationModPerLevel;
    /** @var double */
    public $rPercentMovementSpeedModPerLevel;
    /** @var double */
    public $rPercentTimeDeadMod;
    /** @var double */
    public $rPercentTimeDeadModPerLevel;

    function __construct($data) {
        foreach (get_object_vars($data) as $key => $value) {
            $this->$key=$value; 
        }
    }

}
