<?php

function r_daily_generate_recipe(){
    set_transient('r_daily_recipe', 
    r_get_random_recipe(), 
    'DAY_IN_SECONDS');
}