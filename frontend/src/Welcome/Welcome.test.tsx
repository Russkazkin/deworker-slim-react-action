import React from 'react';
import { render, screen } from '@testing-library/react';
import Welcome from './Welcome';
import { FeaturesEnum, FeaturesProvider } from '../FeatureToggle';
test('renders welcome', () => {
  render(
    <FeaturesProvider features={[]}>
      <Welcome />
    </FeaturesProvider>
  );
  expect(screen.getByText(/We will be here/i)).toBeInTheDocument();
  expect(screen.queryByText(/We are here/i)).not.toBeInTheDocument();
});
test('renders new welcome', () => {
  render(
    <FeaturesProvider features={[FeaturesEnum.WeAreHere]}>
      <Welcome />
    </FeaturesProvider>
  );
  expect(screen.queryByText(/We will be here/i)).not.toBeInTheDocument();
  expect(screen.getByText(/We are here/i)).toBeInTheDocument();
});
