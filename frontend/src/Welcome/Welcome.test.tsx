import React from 'react';
import { render } from '@testing-library/react';
import Welcome from './Welcome';
import { FeaturesContext, FeaturesEnum } from "../FeatureToggle";
test('renders old welcome', () => {
  const { getByText, queryByText } = render(
    <FeaturesContext value={{ features: [] }}>
      <Welcome />
    </FeaturesContext>
  )
  expect(getByText(/We will be here/i)).toBeInTheDocument()
  expect(queryByText(/We are here/i)).toBeNull()
})
test('renders new welcome', () => {
  const { getByText, queryByText } = render(
    <FeaturesContext value={{ features: [FeaturesEnum.WeAreHere] }}>
      <Welcome />
    </FeaturesContext>
  )
  expect(queryByText(/We will be here/i)).toBeNull()
  expect(getByText(/We are here/i)).toBeInTheDocument()
})
