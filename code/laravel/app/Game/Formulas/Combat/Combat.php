<?php namespace App\Game\Formulas\Combat;

use App\Game\Combat\Enemies\Map as EnemiesMap;

/**
 * Class Combat
 * @package App\Game\Formulas\Combat
 */
class Combat
{

    /**
     * @var
     */
    protected $enmiesMap;

    /**
     * Combat constructor.
     */
    public function __construct()
    {
        $this->enemiesMap = new EnemiesMap;
    }

    /**
     * Decides whether or not the player gets to attack first
     * - This will be more complicated eventually, based on enemy & player stats
     *
     * @return bool
     */
    public function DoesPlayerGetFirstMove() {
        $modifier = rand(1, 2);

        return (1 === $modifier);
    }

    /**
     * Accessor for combat formulas specifically relating to enemies
     *
     * @param $enemy
     * @return EnemyCombatFormulas
     */
    public function enemy($enemy)
    {
        return new EnemyCombatFormulas($enemy);
    }

    public function player($player)
    {
        return new PlayerCombatFormulas($player);
    }

    /**
     * Used to find an enemy within a specific location, based on the rarity of the
     * individual enemy.
     *
     * ++ Math Formula ++
     * TR = Total Rarity; RRl = Rarity Range Low; RRh = Rarity Range High
     *
     * Enemy A (Ea) = Rarity 33 (low number means more rare)
     * Enemy B (Eb) = Rarity 66
     * Enemy C (Ec) = Rarity 90
     *
     * RRl = TR + 1
     * RRh = TR + Rarity
     *
     * Going through each enemy:
     * TR = 0
     *
     * Ea
     *  RRl = 0 + 1 = 1
     *  RRh = 0 + 33 = 33
     *  TR = RRh
     *
     * Eb
     *  RRl = 33 + 1 = 34
     *  RRh = 33 + 66 = 99
     *  TR = RRh
     *
     * Ec
     *  RRl = 99 + 1 = 100
     *  RRh = 99 + 90 = 189
     *  TR = RRh
     *
     * ------
     *
     * Pick a rarity index: rand(1, TR)
     *
     * Going through each enemy rarity range:
     *  Fight Ea if: Rarity Index >= 1 && Rarity Index <= 33
     *  Fight Eb if: Rarity Index >= 34 && Rarity Index <= 99
     *  Fight Ec if: Rarity Index >= 100 && Rarity Index <= 189
     *  --
     *  Samples:
     *      RIa = 55 // Should be Eb
     *      RIb = 47 // Should be Eb
     *      RIc = 186 // Should be Ec
     *
     *      55 >= 1 && 55 <= 33 // False
     *      55 >= 34 && 55 <= 99 // True
     *      55 >= 100 && 55 <= 189 // False
     *
     *      47 >= 1 && 47 <= 33 // False
     *      47 >= 34 && 47 <= 99 // True
     *      47 >= 100 && 47 <= 189 // False
     *
     *      186 >= 1 && 186 <= 33 // False
     *      186 >= 34 && 186 <= 99 // False
     *      186 >= 100 && 186 <= 189 // True
     *
     * @param $city
     * @return mixed
     */
    public function findEnemyIn($city)
    {
        $totalRarities = 0;
        $enemyRarityRanges = [];
        $nearByEnemies = $this->enemiesMap->enemiesIn($city);

        // Set all the rarity ranges & the total rarity
        foreach ($nearByEnemies as $enemy) {
            $rarity = $enemy->info()->rarity;

            $enemyRarityRanges[$enemy->info()->name] = [
                'low'  => $totalRarities + 1,
                'high' => $totalRarities + $rarity
            ];

            $totalRarities += $rarity;
        }

        $rarityIndex = rand(1, $totalRarities);

        // Find the right enemy based on the rarity ranges, using the rarity index
        foreach ($enemyRarityRanges as $enemyName => $rarityRange) {
            if ($rarityRange >= $rarityRange['low'] && $rarityIndex <= $rarityRange['high']) {

                // Exit loop, return as early as possible
                return $nearByEnemies[$enemyName];
            }
        }
    }
}
