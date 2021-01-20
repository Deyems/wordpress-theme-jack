const { block_icons } = require("../icons/index");

// console.log(wp);
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { InspectorControls } = wp.editor;
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
                        value="ingredients"
                        onChange={ (new_val) => { 
                            console.log(new_val);
                        }} />
                    <TextControl 
                        label={__('Cooking Time', 'recipe')} 
                        help={__('How long will it take to cook?', 'recipe')} 
                        value="time"
                        onChange={ (new_val) => { 
                            console.log(new_val);
                        }} />
                    <TextControl 
                        label={__('Utensils', 'recipe')} 
                        help={__('Ex: Spoon, Knife, Pots, Pans etc.', 'recipe')} 
                        value="utensils"
                        onChange={ (new_val) => { 
                            console.log(new_val);
                        }} />
                        <SelectControl 
                        label={__('Cooking Experience', 'recipe')}
                        help={__('How skilled should a reader be?', 'recipe')}
                        value={__('Beginner', 'recipe')}
                        options={[
                            { value: 'Beginner', label: 'Beginner'},
                            { value: 'Intermediate', label: 'Intermediate'},
                            { value: 'Expert', label: 'Expert'}
                        ]}
                        onChange={ (new_val) => {
                            console.log(new_val);
                        }}
                        />
                        <SelectControl 
                        label={__('Meal Type', 'recipe')}
                        help={__('When is this best taken?', 'recipe')}
                        value={__('Breakfast', 'recipe')}
                        options={[
                            { value: 'Breakfast', label: 'Breakfast'},
                            { value: 'Lunch', label: 'Lunch'},
                            { value: 'Dinner', label: 'Dinner'}
                        ]}
                        onChange={ (new_val) => {
                            console.log(new_val);
                        }}
                        />
                </PanelBody>
            </InspectorControls>,
            <div className={props.className}>
                <ul className="list-unstyled">
                    <li><strong>{ __('Ingredients', 'recipe')}:</strong>INGREDIENTS_PH</li>
                    <li><strong>{ __('Cooking Time', 'recipe')}:</strong>COOKING_TIME_PH</li>
                    <li><strong>{ __('Utensils', 'recipe')}:</strong>UTENSILS_PH</li>
                    <li><strong>{ __('Cooking Experience', 'recipe')}:</strong>LEVEL_PH</li>
                    <li><strong>{ __('Meal Type', 'recipe')}:</strong>TYPE_PH</li>
                </ul>
            </div>
        ]
    },
    save: (props) => {
        return <p> Hello World</p>
    }
});
