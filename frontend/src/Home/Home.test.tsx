import React from 'react';
import { render, screen } from '@testing-library/react';
import Home from './Home';
import { FeaturesEnum, FeaturesProvider } from '../FeatureToggle';
test('renders home', () => {
  render(
    <FeaturesProvider features={[]}>
      <Home />
    </FeaturesProvider>
  );
  expect(screen.getByText(/We will be here/i)).toBeInTheDocument();
  expect(screen.queryByText(/We are here/i)).not.toBeInTheDocument();
});
test('renders new home', () => {
  render(
    <FeaturesProvider features={[FeaturesEnum.WeAreHere]}>
      <Home />
    </FeaturesProvider>
  );
  expect(screen.queryByText(/We will be here/i)).not.toBeInTheDocument();
  expect(screen.getByText(/We are here/i)).toBeInTheDocument();
});
