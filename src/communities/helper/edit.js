/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
 import { 
	useBlockProps,
	InspectorControls
} from '@wordpress/block-editor';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */

import { 
    Placeholder, 
    PanelBody, 
    RangeControl, 
    SelectControl,
    CheckboxControl
} from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import '../assets/editor.scss';

import ServerSideRender from '@wordpress/server-side-render';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( props ) {

	const { className, attributes, setAttributes } = props; 
    
	const blockProps = useBlockProps();

	const themeList = [
		{ label: 'Element',    value: 'element' },
        { label: 'Classic',    value: 'classic' },
		{ label: 'Iconic',     value: 'iconic' },
		{ label: 'Legacy', 	   value: 'legacy' },
		{ label: 'Minimalist', value: 'minimalist' },
	] 

	function updateTheme ( val ){
		props.setAttributes( { selected_theme: val } );
	}

	function updateNoShown( val ){
		props.setAttributes( { no_shown: val } );
	}

	function updateFeatured( val ){
		props.setAttributes( { featured_communities: val } );
	}

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody
					title={ __('AIOS Communities Block Settings') }
					initialOpen={ true }
					className="aios-block-container"
				>
					<fieldset className="aios-form-group">
                        <div class="aios-block-col">
                            <legend for="selected_theme">
                                { __( 'Select Theme:', 'aios-communities' ) }
                            </legend>
                        </div>
                        <div class="aios-block-col">
                            <SelectControl
                                className="aios-form-control"
                                name="selected_theme"
                                id="selected_theme"
                                value={ attributes.selected_theme }
                                options={ themeList }
                                onChange={ ( val ) => updateTheme(val) }
                            />
                        </div>
                    </fieldset>
                    <fieldset className="aios-form-group">
                        <div class="aios-block-col">
                            <legend for="no_shown">
                                { __( 'Items Shown:', 'aios-communities' ) }
                            </legend>
                        </div>
                        <div class="aios-block-col">
                            <RangeControl
                                value={ attributes.no_shown }
                                className="aios-form-control"
                                name="no_shown"
                                id="no_shown"
                                min={ 1 }
                                max={ 10 }
                                onChange={ ( val ) => updateNoShown(val) }
                            />
                        </div>
                    </fieldset>
                    <fieldset className="aios-form-group aios-checkbox">
                        <div class="aios-block-col">
                            <legend for="featured_communities">
                                { __( 'Featured Only?', 'aios-communities' ) }
                            </legend>
                        </div>
                        <div class="aios-block-col">
                            <CheckboxControl
                                name="featured_communities"
                                id="featured_communities"                               
                                className="aios-form-control"
                                checked={ attributes.featured_communities }                        
                                onChange={ ( val ) => updateFeatured(val) }
                            />
                        </div>
                    </fieldset>
				</PanelBody>
			</InspectorControls>

			<div class="aios-block-preview">
                <ServerSideRender 
                    block="create-block/aios-communities-block"
                    attributes={ props.attributes }
                />
            </div>
		</div>
	);
}
