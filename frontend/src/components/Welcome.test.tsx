import React from 'react';
import { render, screen } from '@testing-library/react';
import Welcome from "./Welcome";

test('renders Welcome', () => {
  const { getByText } = render(<Welcome />);
  const h1Element = getByText(/Auction/i);
  expect(h1Element).toBeInTheDocument();
});
