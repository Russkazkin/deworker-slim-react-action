import React from 'react';
import { render, screen } from '@testing-library/react';
import App from './App';

test('renders learn react link', () => {
  render(<App features={[]} />);
  expect(screen.getAllByTestId('App')).toHaveLength(1);
});
