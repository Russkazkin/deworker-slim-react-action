import globals from "globals";
import pluginJs from "@eslint/js";
import tseslint from "typescript-eslint";
import pluginReactConfig from "eslint-plugin-react/configs/recommended.js";
import deprecationPlugin from 'eslint-plugin-deprecation';
import eslintCommentsPlugin from 'eslint-plugin-eslint-comments';
import eslintPluginPlugin from 'eslint-plugin-eslint-plugin';
import jestPlugin from 'eslint-plugin-jest';
import jsdocPlugin from 'eslint-plugin-jsdoc';
import reactHooksPlugin from 'eslint-plugin-react-hooks';
import simpleImportSortPlugin from 'eslint-plugin-simple-import-sort';
import unicornPlugin from 'eslint-plugin-unicorn';
import eslintConfigPrettier from "eslint-config-prettier";


export default [
  {files: ["**/*.{js,mjs,cjs,ts,jsx,tsx}"]},
  {plugins:
    {
      ['@typescript-eslint']: tseslint.plugin,
      ['deprecation']: deprecationPlugin,
      ['eslint-comments']: eslintCommentsPlugin,
      ['eslint-plugin']: eslintPluginPlugin,
      ['jest']: jestPlugin,
      ['jsdoc']: jsdocPlugin,
      ['react-hooks']: reactHooksPlugin,
      ['simple-import-sort']: simpleImportSortPlugin,
      ['unicorn']: unicornPlugin,
    },
  },
  { languageOptions: { parserOptions: { ecmaFeatures: { jsx: true } } } },
  {languageOptions: { globals: {...globals.browser, ...globals.node} }},
  pluginJs.configs.recommended,
  ...tseslint.configs.recommended,
  pluginReactConfig,
  {settings: {react: {version: 'detect'}}},
  {rules:
    {
      'no-unused-vars': 'warn',
      semi: [2, 'always'],
      quotes: [2, 'single'],
      indent: [2, 2],
      'comma-dangle': [2, {
          arrays: 'always-multiline',
          objects: 'always-multiline',
        }
      ],
    }
  },
  eslintConfigPrettier,
];
