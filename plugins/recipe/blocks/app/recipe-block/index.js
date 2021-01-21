const { block_icons } = require("../icons/index");
import "./editor.scss";
// console.log(wp);
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const {PanelBody, PanelRow, TextControl, SelectControl } = wp.components;

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
    attributes: {
        ingredients: {
            type: 'string',
            source: 'text',
            selector: '.ingredients-ph'
        },
        cooking_time: {
            type: 'string',
            source: 'text',
            selector: '.cooking-time-ph'
        },
        utensils: {
            type: 'string',
            source: 'text',
            selector: '.utensils-ph'
        },
        cooking_experience: {
            type: 'string',
            source: 'text',
            selector: '.cooking-experience-ph',
            default: 'Beginner'
        },
        meal_type: {
            type: 'string',
            source: 'text',
            selector: '.meal-type-ph',
            default: 'Breakfast'
        },
    },
    edit: (props) => {
        // console.log(props);
        return [
            <InspectorControls>
                <PanelBody title={__('Basics', 'recipe')}>
                    <PanelRow>
                        <p>{__('Configure the contents of your block here', 'recipe')}</p>
                    </PanelRow>
                    <TextControl 
                        label={__('Ingredients', 'recipe')} 
                        help={__('Ex: Tomatoes, Lettuce, Onions etc.', 'recipe')} 
                        value={props.attributes.ingredients}
                        onChange={ (new_val) => { 
                            props.setAttributes({ingredients: new_val})
                        }} />
                    <TextControl 
                        label={__('Cooking Time', 'recipe')} 
                        help={__('How long will it take to cook?', 'recipe')} 
                        value={props.attributes.cooking_time}
                        onChange={ (new_val) => { 
                            props.setAttributes({cooking_time: new_val})
                        }} />
                    <TextControl 
                        label={__('Utensils', 'recipe')} 
                        help={__('Ex: Spoon, Knife, Pots, Pans etc.', 'recipe')} 
                        value={props.attributes.utensils}
                        onChange={ (new_val) => { 
                            props.setAttributes({utensils: new_val})
                        }} />
                        <SelectControl 
                        label={__('Cooking Experience', 'recipe')}
                        help={__('How skilled should a reader be?', 'recipe')}
                        value={props.attributes.cooking_experience}
                        options={[
                            { value: 'Beginner', label: 'Beginner'},
                            { value: 'Intermediate', label: 'Intermediate'},
                            { value: 'Expert', label: 'Expert'}
                        ]}
                        onChange={ (new_val) => {
                            props.setAttributes({cooking_experience: new_val})
                        }}
                        />
                        <SelectControl 
                        label={__('Meal Type', 'recipe')}
                        help={__('When is this best taken?', 'recipe')}
                        value={props.attributes.meal_type}
                        options={[
                            { value: 'Breakfast', label: 'Breakfast'},
                            { value: 'Lunch', label: 'Lunch'},
                            { value: 'Dinner', label: 'Dinner'}
                        ]}
                        onChange={ (new_val) => {
                            props.setAttributes({meal_type: new_val})
                        }}
                        />
                </PanelBody>
            </InspectorControls>,
            <div className={props.className}>
                <ul className="list-unstyled">
                    <li><strong>{ __('Ingredients', 'recipe')}:</strong>
                        <span className="ingredients-ph">{props.attributes.ingredients}</span>
                    </li>
                    <li><strong>{ __('Cooking Time', 'recipe')}:</strong>
                        <span className="cooking-time-ph">{props.attributes.cooking_time}</span>
                    </li>
                    <li><strong>{ __('Utensils', 'recipe')}:</strong>
                        <span className="utensils-ph">{props.attributes.utensils}</span>
                    </li>
                    <li><strong>{ __('Cooking Experience', 'recipe')}:</strong>
                        <span className="cooking-experience-ph">{props.attributes.cooking_experience}</span>
                    </li>
                    <li><strong>{ __('Meal Type', 'recipe')}:</strong>
                        <span className="meal-type-ph">{props.attributes.meal_type}</span>
                    </li>
                </ul>
            </div>
        ]
    },
    save: (props) => {
        return (
            <div>
                <ul className="list-unstyled">
                    <li><strong>{ __('Ingredients', 'recipe')}:</strong>
                        <span className="ingredients-ph">{props.attributes.ingredients}</span>
                    </li>
                    <li><strong>{ __('Cooking Time', 'recipe')}:</strong>
                        <span className="cooking-time-ph">{props.attributes.cooking_time}</span>
                    </li>
                    <li><strong>{ __('Utensils', 'recipe')}:</strong>
                        <span className="utensils-ph">{props.attributes.utensils}</span>
                    </li>
                    <li><strong>{ __('Cooking Experience', 'recipe')}:</strong>
                        <span className="cooking-experience-ph">{props.attributes.cooking_experience}</span>
                    </li>
                    <li><strong>{ __('Meal Type', 'recipe')}:</strong>
                        <span className="meal-type-ph">{props.attributes.meal_type}</span>
                    </li>
                </ul>
            </div>
        )
    }
});
