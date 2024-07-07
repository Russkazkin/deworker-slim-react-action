import React from 'react';
import { render, screen } from '@testing-library/react';
import Welcome from "./Welcome";

test('renders Welcome', () => {
  render(<Welcome />);
  const h1Element = screen.getByText(/Auction/i);
  expect(h1Element).toBeInTheDocument();
});
