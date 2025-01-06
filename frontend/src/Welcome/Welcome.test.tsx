import React from 'react';
import { render } from '@testing-library/react';
import Welcome from './Welcome';
import { FeaturesEnum, FeaturesProvider } from "../FeatureToggle";
test('renders welcome', () => {
  const { getByText, queryByText } = render(
    <FeaturesProvider features={[]}>
      <Welcome />
    </FeaturesProvider>
  )
  expect(getByText(/We will be here/i)).toBeInTheDocument()
  expect(queryByText(/We are here/i)).toBeNull()
})
test('renders new welcome', () => {
  const { getByText, queryByText } = render(
    <FeaturesProvider features={[FeaturesEnum.WeAreHere]}>
      <Welcome />
    </FeaturesProvider>
  )
  expect(queryByText(/We will be here/i)).toBeNull()
  expect(getByText(/We are here/i)).toBeInTheDocument()
})
