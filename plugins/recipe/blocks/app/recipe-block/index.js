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
    edit: (props) => {
        // console.log(props);
        return (
            <div className={props.className}>
                <ul className="list-unstyled">
                    <li><strong>{ __('Ingredients', 'recipe')}:</strong>INGREDIENTS_PH</li>
                    <li><strong>{ __('Cooking Time', 'recipe')}:</strong>COOKING_TIME_PH</li>
                    <li><strong>{ __('Utensils', 'recipe')}:</strong>UTENSILS_PH</li>
                    <li><strong>{ __('Cooking Experience', 'recipe')}:</strong>LEVEL_PH</li>
                    <li><strong>{ __('Meal Type', 'recipe')}:</strong>TYPE_PH</li>
                </ul>
            </div>
        )
    },
    save: (props) => {
        return <p> Hello World</p>
    }
});
