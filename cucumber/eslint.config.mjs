import js from "@eslint/js";
import globals from "globals";

export default [
  js.configs.recommended,
  {languageOptions: { globals: { ...globals.node} }},
  {
    rules: {
      "no-unused-vars": "warn",
      "no-undef": "warn",
      semi: [2, 'always'],
      quotes: [2, 'single'],
      indent: [2, 2],
    }
  }
];
