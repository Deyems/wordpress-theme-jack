const { block_icons } = require("../icons/index");

// console.log(wp);
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

registerBlockType('udemy/recipe', {
    title: __('Recipe', 'recipe'),
    description: __('Provides a short summary of a recipe', 'recipe'),
    //Text, Design, Widget, Embed, Media
    category: __('common', 'recipe'),
    icon: block_icons.wapuu,
    keywords: [
        __('Food', 'recipe'),
        __('Ingredients', 'recipe'),
        __('Meal Type', 'recipe'),
    ],
    suppport: {
        html: false,
    },
    edit: () => {
        return <p> Hello World</p>
    },
    save: () => {
        return <p> Hello World</p>
    }
});
