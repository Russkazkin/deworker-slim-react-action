import js from '@eslint/js';
import globals from 'globals';

export default [
  js.configs.recommended,
  {languageOptions: { globals: { ...globals.node, ...globals.browser } }},
  {
    rules: {
      'no-unused-vars': 'warn',
      'no-undef': 'warn',
      semi: [2, 'always'],
      quotes: [2, 'single'],
      indent: [2, 2],
      'comma-dangle': [2, {
        arrays: 'always-multiline',
        objects: 'always-multiline',
      },
      ],
    }
  }
];
