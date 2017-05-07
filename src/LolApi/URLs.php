<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi;

/**
 * Description of LolApiResources
 *
 * @author Javier
 */
class URLs {

    // ~ Resources URLS ~ 
    const R_URL_CHAMPION = "https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion"; //deprecated
    const R_URL_CHAMPION_ID = "https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion/{id}"; //deprecated
    
    const R_URL_CHAMPION_v3 = "https://{platformId}.api.riotgames.com/lol/platform/v3/champions";
    const R_URL_CHAMPION_ID_v3 = "https://{platformId}.api.riotgames.com/lol/platform/v3/champions/{id}";
    
    const R_URL_CHAMPION_MASTERY_CHAMP_ID = "https://{region}.api.pvp.net/championmastery/location/{platformId}/player/{playerId}/champion/{championId}"; //deprecated
    const R_URL_CHAMPION_MASTERY_LIST = "https://{region}.api.pvp.net/championmastery/location/{platformId}/player/{playerId}/champions"; //deprecated
    const R_URL_CHAMPION_MASTERY_SCORE = "https://{region}.api.pvp.net/championmastery/location/{platformId}/player/{playerId}/score"; //deprecated
    const R_URL_CHAMPION_MASTERY_TOP = "https://{region}.api.pvp.net/championmastery/location/{platformId}/player/{playerId}/topchampions"; //deprecated
    
    const R_URL_CHAMPION_MASTERY_CHAMP_ID_v3 = "https://{platformId}.api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}/by-champion/{championId}";
    const R_URL_CHAMPION_MASTERY_LIST_v3 = "https://{platformId}.api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}";
    const R_URL_CHAMPION_MASTERY_SCORE_v3 = "https://{platformId}.api.riotgames.com/lol/champion-mastery/v3/scores/by-summoner/{summonerId}";
    
    const R_URL_CURRENT_GAME = "https://{region}.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/{platformId}/{summonerId}"; //deprecated
    
    const R_URL_CURRENT_GAME_v3 = "https://{platformId}.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/{summonerId}";
    
    const R_URL_FEATURED_GAMES = "https://{region}.api.pvp.net/observer-mode/rest/featured"; //deprecated
    
    const R_URL_FEATURED_GAMES_v3 = "https://{platformId}.api.riotgames.com/lol/spectator/v3/featured-games"; 
    
    const R_URL_RECENT_GAMES = "https://{region}.api.pvp.net/api/lol/{region}/v1.3/game/by-summoner/{summonerId}/recent"; //deprecated
    
    //VOY POR AKI
    
    const R_URL_LEAGUES_BY_SUMMONERS = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/by-summoner/{summonerIds}";
    const R_URL_LEAGUES_BY_SUMMONERS_ENTRY = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/by-summoner/{summonerIds}/entry";
    const R_URL_LEAGUES_BY_TEAMS = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/by-team/{teamIds}";
    const R_URL_LEAGUES_BY_TEAMS_ENTRY = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/by-team/{teamIds}/entry";
    const R_URL_LEAGUE_CHALLENGER = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/challenger";
    const R_URL_LEAGUE_MASTER = "https://{region}.api.pvp.net/api/lol/{region}/v2.5/league/master";
    const R_URL_STATIC_DATA_CHAMPION = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/champion";
    const R_URL_STATIC_DATA_CHAMPION_ID = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/champion/{id}";
    const R_URL_STATIC_DATA_ITEM = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/item";
    const R_URL_STATIC_DATA_ITEM_ID = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/item/{id}";
    const R_URL_STATIC_DATA_LANGUAGE_STRINGS = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/language-strings";
    const R_URL_STATIC_DATA_LANGUAGES = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/languages";
    const R_URL_STATIC_DATA_MAPS = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/map";
    const R_URL_STATIC_DATA_MASTERY = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/mastery";
    const R_URL_STATIC_DATA_MASTERY_ID = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/mastery/{id}";
    const R_URL_STATIC_DATA_REALM = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/realm";
    const R_URL_STATIC_DATA_RUNE = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/rune";
    const R_URL_STATIC_DATA_RUNE_ID = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/rune/{id}";
    const R_URL_STATIC_DATA_SUMMONER_SPELL = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/summoner-spell";
    const R_URL_STATIC_DATA_SUMMONER_SPELL_ID = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/summoner-spell/{id}";
    const R_URL_STATIC_DATA_VERSIONS = "https://global.api.pvp.net/api/lol/static-data/{region}/v1.2/versions";
    const R_URL_STATUS_SHARDS = "http://status.leagueoflegends.com/shards";
    const R_URL_STATUS_SHARDS_SHARD = "http://status.leagueoflegends.com/shards/{shard}";
    const R_URL_MATCH = "https://{region}.api.pvp.net/api/lol/{region}/v2.2/match/{matchId}";
    const R_URL_MATCHLIST = "https://{region}.api.pvp.net/api/lol/{region}/v2.2/matchlist/by-summoner/{summonerId}";
    const R_URL_STATS_RANKED = "https://{region}.api.pvp.net/api/lol/{region}/v1.3/stats/by-summoner/{summonerId}/ranked";
    const R_URL_STATS_SUMMARY = "https://{region}.api.pvp.net/api/lol/{region}/v1.3/stats/by-summoner/{summonerId}/summary";
    const R_URL_SUMMONER_BY_NAME = "https://{region}.api.pvp.net/api/lol/{region}/v1.4/summoner/by-name/{summonerNames}";
    const R_URL_SUMMONER_BY_ID = "https://{region}.api.pvp.net/api/lol/{region}/v1.4/summoner/{summonerIds}";
    const R_URL_SUMMONER_MASTERIES = "https://{region}.api.pvp.net/api/lol/{region}/v1.4/summoner/{summonerIds}/masteries";
    const R_URL_SUMMONER_NAME = "https://{region}.api.pvp.net/api/lol/{region}/v1.4/summoner/{summonerIds}/name";
    const R_URL_SUMMONER_RUNES = "https://{region}.api.pvp.net/api/lol/{region}/v1.4/summoner/{summonerIds}/runes";
    const R_URL_TEAM_BY_SUMMONER = "https://{region}.api.pvp.net/api/lol/{region}/v2.4/team/by-summoner/{summonerIds}";
    const R_URL_TEAM_BY_TEAMID = "https://{region}.api.pvp.net/api/lol/{region}/v2.4/team/{teamIds}";
    // ~ TOURNAMENT API ~
    const R_URL_TOURNAMENT_PUBLIC_PROVIDER = "https://{region}.api.pvp.net/tournament/public/v1/provider"; //post
    const R_URL_TOURNAMENT_PUBLIC_TOURNAMENT = "https://{region}.api.pvp.net/tournament/public/v1/tournament"; //post
    const R_URL_TOURNAMENT_PUBLIC_CODE = "https://{region}.api.pvp.net/tournament/public/v1/code"; //post
    const R_URL_TOURNAMENT_PUBLIC_CODE_TOURNAMENTCODE = "https://{region}.api.pvp.net/tournament/public/v1/code/{tournamentCode}"; //put
    const R_URL_TOURNAMENT_PUBLIC_LOBBY_EVENTS_BY_CODE = "https://{region}.api.pvp.net/tournament/public/v1/lobby/events/by-code/{tournamentCode}"; //get
    const R_URL_TOURNAMENT_PUBLIC_MATCH_BY_TOURNAMENT = "https://{region}.api.pvp.net/api/lol/{region}/v2.2/match/by-tournament/{tournamentCode}/ids"; //get
    const R_URL_TOURNAMENT_PUBLIC_MATCH_FOR_TOURNAMENT = "https://{region}.api.pvp.net/api/lol/{region}/v2.2/match/for-tournament/{matchId}"; //get
    // ~ IMG URLS ~ 
    const IMG_URL_PROFILE_ICONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/profileicon/{id}.png';
    const IMG_URL_CHAMPIONS_SPLASH_ART = 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/{key}_{num}.jpg';
    const IMG_URL_CHAMPIONS_LOADING_SCREEN_ART = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/{key}_{num}.jpg';
    const IMG_URL_CHAMPIONS_SQUARE = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/champion/{full}';
    const IMG_URL_CHAMPIONS_PASSIVE_ABILITIES = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/passive/{full}';
    const IMG_URL_CHAMPIONS_ABILITIES = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/spell/{full}';
    const IMG_URL_SUMMONER_SPELLS = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/spell/{full}';
    const IMG_URL_ITEMS = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/item/{id}.png';
    const IMG_URL_MASTERIES = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/mastery/{id}.png';
    const IMG_URL_RUNES = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/rune/{full}';
    const IMG_URL_SPRITES = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/sprite/{full}';
    const IMG_URL_MINIMAPS = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/map/{id}.png';
    const IMG_URL_SCOREBOARD_ICONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/img/ui/{icon}.png';
    const IMG_URL_TIER_BASE_ICONS = '/assets/images/tier-icons/base_icons/{tier}.png';
    const IMG_URL_TIER_DIVISION_ICONS = '/assets/images/tier-icons/tier_icons/{tier}_{division}.png';
    // ~ JSON URLS ~ 
    const JSON_URL_PROFILE_ICONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/profileicon.json';
    const JSON_URL_CHAMPIONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/champion.json';
    const JSON_URL_INDIVIDUAL_CHAMPIONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/champion/{key}.json';
    const JSON_URL_ITEMS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/item.json';
    const JSON_URL_MASTERIES = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/mastery.json';
    const JSON_URL_RUNES = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/rune.json';
    const JSON_URL_SUMMONER_SPELLS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/summoner.json';
    const JSON_URL_LANGUAGES = 'https://ddragon.leagueoflegends.com/cdn/languages.json';
    const JSON_URL_TRADUCTIONS = 'http://ddragon.leagueoflegends.com/cdn/{v}/data/{locale}/language.json';

}
