## How to Use

To have the lightbox display automatically on a page when a user visits, fill out the fields on the global settings page and then use the shortcode:  `[en_donation_lightbox]`.

You can override the fields for an individual page by specifying them as attributes on the shortcode.  
  
**Example:**  `[en_donation_lightbox url='https://somedomain.com/overridden-by-this-string/1' title='Overridden by this String' script='https://somedomain.com/overridden-by-this-string.js' image='https://somedomain.com/overridden-by-this-string.jpg' logo='https://somedomain.com/overridden-by-this-string.jpg' footer='Overridden by this string'].`  
  
**NOTE:**  To override the 'paragraph' field, the procedure is a little different. You must set the shortcode to have both an open and close tag, and set the paragraph content in-between.  
  
**Example:**  `[en_donation_lightbox url='https://somedomain.com/overridden-by-this-string/1' title='Overridden by this String' script='https://somedomain.com/overridden-by-this-string.js' image='https://somedomain.com/overridden-by-this-string.jpg' logo='https://somedomain.com/overridden-by-this-string.jpg' footer='Overridden by this string']This is my overridden content for the lightbox.[/en_donation_lightbox]`

Additionally, you have the option of adding data attributes to &lt;a&gt; tags (links) in your page, so that a click of that link will open a donation form modal. You  **MUST**  have the "autoload" field checked on the global settings page to use this feature (see below form).  
  
**Example:**  `<a href='https://domain.com/link-to-the-form/1' data-donation-lightbox data-title='your-title' data-paragraph='your-paragraph-content' data-image='https://domain.com/link-to-your-image.jpg' data-footer='your-footer-content' data-logo='https://domain.com/link-to-your-logo.svg'>Click here</a>`
